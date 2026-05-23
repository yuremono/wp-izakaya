#!/usr/bin/env bash
# Build the theme, package a deployable ZIP, and optionally sync it to a remote WordPress install.
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "${SCRIPT_DIR}/.." && pwd)"
THEME_SLUG="${DEPLOY_THEME_SLUG:-$(basename "${ROOT_DIR}")}"
ZIP_NAME="${DEPLOY_ZIP_NAME:-0520portfolio-wp-theme.zip}"
ZIP_PATH="${ROOT_DIR}/dist/${ZIP_NAME}"
DEFAULT_IMPORT_XML="${ROOT_DIR}/exports/yuremono-wp-content.xml"

if [[ -f "${ROOT_DIR}/.env.deploy" ]]; then
	set -a
	# shellcheck disable=SC1091
	source "${ROOT_DIR}/.env.deploy"
	set +a
fi

discover_php() {
	local candidate

	if command -v php >/dev/null 2>&1; then
		command -v php
		return 0
	fi

	shopt -s nullglob
	for candidate in \
		"${HOME}/Library/Application Support/Local/lightning-services"/php-*/bin/darwin-arm64/bin/php \
		"${HOME}/Library/Application Support/Local/lightning-services"/php-*/bin/darwin-x86_64/bin/php \
		"/Applications/Local.app/Contents/Resources/extraResources/lightning-services"/php-*/bin/darwin-arm64/bin/php \
		"/Applications/Local.app/Contents/Resources/extraResources/lightning-services"/php-*/bin/darwin-x86_64/bin/php; do
		if [[ -x "$candidate" ]]; then
			printf '%s\n' "$candidate"
			return 0
		fi
	done

	return 1
}

PHP_BIN="${PORTFOLIO_PHP:-}"
if [[ -z "$PHP_BIN" ]]; then
	if ! PHP_BIN="$(discover_php)"; then
		PHP_BIN=""
	fi
fi

build_assets() {
	echo "==> npm run build"
	(
		cd "${ROOT_DIR}"
		npm run build
	)
}

run_phpcs() {
	if [[ "${DEPLOY_SKIP_PHPCS:-0}" == "1" ]]; then
		echo "==> phpcs skipped"
		return 0
	fi

	if [[ -z "$PHP_BIN" ]]; then
		echo "PHP が見つかりません。DEPLOY_SKIP_PHPCS=1 を付けるか、PORTFOLIO_PHP で PHP のフルパスを指定してください。" >&2
		exit 1
	fi

	if [[ ! -x "${ROOT_DIR}/vendor/bin/phpcs" ]]; then
		echo "vendor/bin/phpcs が見つかりません。composer install を実行してください。" >&2
		exit 1
	fi

	echo "==> phpcs"
	"$PHP_BIN" "${ROOT_DIR}/vendor/bin/phpcs" --standard="${ROOT_DIR}/phpcs.xml.dist"
}

stage_theme() {
	local stage_dir="$1"
	local stage_theme_dir="${stage_dir}/${THEME_SLUG}"
	local -a rsync_excludes=(
		--exclude '.codex/'
		--exclude '.git/'
		--exclude '.gitignore'
		--exclude '.vscode/'
		--exclude '.memsearch/'
		--exclude '.DS_Store'
		--exclude 'dist/'
		--exclude 'exports/'
		--exclude 'assets/scss/'
		--exclude 'assets/src/'
		--exclude 'node_modules/'
		--exclude 'vendor/'
		--exclude '*.bak'
		--exclude '*.md'
		--exclude '*.scss'
		--exclude '*.ts'
		--exclude 'composer.json'
		--exclude 'composer.lock'
		--exclude 'package.json'
		--exclude 'package-lock.json'
		--exclude 'phpcs.xml.dist'
		--exclude 'postcss.config.cjs'
		--exclude 'tailwind.config.cjs'
		--exclude 'tools/'
		--exclude '*.log'
		--exclude '.env'
		--exclude '.env.*'
	)

	mkdir -p "$stage_theme_dir"
	rsync -a "${rsync_excludes[@]}" "${ROOT_DIR}/" "${stage_theme_dir}/"
}

make_zip() {
	local stage_dir
	stage_dir="$(mktemp -d "${TMPDIR:-/tmp}/portfolio-theme.XXXXXX")"
	trap "rm -rf '${stage_dir}'" RETURN

	rm -f "$ZIP_PATH"
	mkdir -p "${ROOT_DIR}/dist"
	stage_theme "$stage_dir"
	(
		cd "$stage_dir"
		zip -qr "$ZIP_PATH" "$THEME_SLUG"
	)
	echo "==> ZIP created: ${ZIP_PATH}"
}

sync_remote() {
	local host="${DEPLOY_HOST:-}"
	local user="${DEPLOY_USER:-}"
	local path="${DEPLOY_PATH:-}"
	local port="${DEPLOY_PORT:-22}"
	local delete_flag=()
	local remote
	local remote_path_quoted

	if [[ -z "$host" || -z "$user" || -z "$path" ]]; then
		echo "==> remote sync skipped"
		return 0
	fi

	if [[ "$path" != *"/wp-content/themes/"* ]]; then
		echo "DEPLOY_PATH は wp-content/themes 配下を指してください: ${path}" >&2
		exit 1
	fi

	remote="${user}@${host}"
	remote_path_quoted="$(printf '%q' "$path")"

	if [[ "${DEPLOY_DELETE:-0}" == "1" ]]; then
		delete_flag=(--delete)
	fi

	echo "==> syncing to ${remote}:${path}"
	ssh -p "$port" "$remote" "mkdir -p ${remote_path_quoted}"
	rsync -az "${delete_flag[@]}" \
		--exclude '.codex/' \
		--exclude '.git/' \
		--exclude '.gitignore' \
		--exclude '.vscode/' \
		--exclude '.memsearch/' \
		--exclude '.DS_Store' \
		--exclude 'dist/' \
		--exclude 'exports/' \
		--exclude 'assets/scss/' \
		--exclude 'assets/src/' \
		--exclude 'node_modules/' \
		--exclude 'vendor/' \
		--exclude '*.bak' \
		--exclude '*.md' \
		--exclude '*.scss' \
		--exclude '*.ts' \
		--exclude 'composer.json' \
		--exclude 'composer.lock' \
		--exclude 'package.json' \
		--exclude 'package-lock.json' \
		--exclude 'phpcs.xml.dist' \
		--exclude 'postcss.config.cjs' \
		--exclude 'tailwind.config.cjs' \
		--exclude 'tools/' \
		--exclude '*.log' \
		--exclude '.env' \
		--exclude '.env.*' \
		-e "ssh -p ${port}" \
		"${ROOT_DIR}/" \
		"${remote}:${path}/"
}

derive_wp_path() {
	local theme_path="${1:-}"
	local derived

	if [[ -n "${DEPLOY_WP_PATH:-}" ]]; then
		printf '%s\n' "${DEPLOY_WP_PATH}"
		return 0
	fi

	derived="${theme_path%/wp-content/themes/*}"
	if [[ "$derived" == "$theme_path" ]]; then
		return 1
	fi

	printf '%s\n' "$derived"
}

import_remote_content() {
	local xml_path="${DEPLOY_IMPORT_XML:-$DEFAULT_IMPORT_XML}"
	local host="${DEPLOY_HOST:-}"
	local user="${DEPLOY_USER:-}"
	local path="${DEPLOY_PATH:-}"
	local port="${DEPLOY_PORT:-22}"
	local remote
	local remote_wp_path
	local remote_xml_path
	local remote_wp_cli="${DEPLOY_REMOTE_WP_CLI:-wp}"

	if [[ ! -f "$xml_path" ]]; then
		echo "==> content import skipped: XML not found at ${xml_path}"
		return 0
	fi

	if [[ -z "$host" || -z "$user" || -z "$path" ]]; then
		echo "==> content import skipped: DEPLOY_HOST / DEPLOY_USER / DEPLOY_PATH are required"
		return 0
	fi

	if ! remote_wp_path="$(derive_wp_path "$path")"; then
		echo "DEPLOY_WP_PATH を設定してください。DEPLOY_PATH から WordPress ルートを推測できませんでした: ${path}" >&2
		exit 1
	fi

	remote="${user}@${host}"
	remote_xml_path="/tmp/$(basename "$xml_path")"

	echo "==> uploading XML to ${remote}:${remote_xml_path}"
	scp -P "$port" "$xml_path" "${remote}:${remote_xml_path}"

	echo "==> importing XML into ${remote_wp_path}"
	ssh -p "$port" "$remote" "cd $(printf '%q' "$remote_wp_path") && ${remote_wp_cli} import $(printf '%q' "$remote_xml_path") --authors=create"
	ssh -p "$port" "$remote" "rm -f $(printf '%q' "$remote_xml_path")" || true
}

main() {
	local zip_only=0
	local no_phpcs=0
	local import_xml=0

	for arg in "$@"; do
		case "$arg" in
			--zip-only)
				zip_only=1
				;;
			--no-phpcs)
				no_phpcs=1
				;;
			--import-xml)
				import_xml=1
				;;
		esac
	done

	build_assets
	if [[ "$no_phpcs" -eq 0 ]]; then
		run_phpcs
	fi
	make_zip

	if [[ "$zip_only" -eq 0 ]]; then
		sync_remote
		if [[ "$import_xml" -eq 1 ]]; then
			import_remote_content
		fi
	fi
}

main "$@"
