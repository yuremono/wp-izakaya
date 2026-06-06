#!/usr/bin/env bash
# Run bootstrap-site.example.php with a Local-compatible PHP binary.
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PHP_BIN="${THEME_LOCAL_PHP:-${DEPLOY_PHP:-}}"
PHP_INI="${THEME_LOCAL_PHP_INI:-}"

if [[ -z "$PHP_BIN" ]]; then
	PHP_BIN="$(command -v php || true)"
fi

if [[ -z "$PHP_BIN" ]]; then
	echo "PHP が見つかりません。THEME_LOCAL_PHP に PHP のフルパスを指定してください。" >&2
	exit 127
fi

PHP_ARGS=()
if [[ -n "$PHP_INI" ]]; then
	PHP_ARGS=(-c "$PHP_INI")
fi

"$PHP_BIN" "${PHP_ARGS[@]}" "${SCRIPT_DIR}/bootstrap-site.example.php" "$@"
