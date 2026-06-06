#!/usr/bin/env bash
# Copy the repository first, then replace these defaults.
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

export DEPLOY_THEME_SLUG="${DEPLOY_THEME_SLUG:-example-theme}"
export DEPLOY_ZIP_NAME="${DEPLOY_ZIP_NAME:-example-theme.zip}"

exec "${SCRIPT_DIR}/../tools/deploy.sh" "$@"
