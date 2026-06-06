#!/usr/bin/env bash
# Deploy helper for the Quests theme. Keeps project-specific defaults out of tools/deploy.sh.
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

export DEPLOY_THEME_SLUG="${DEPLOY_THEME_SLUG:-quests}"
export DEPLOY_ZIP_NAME="${DEPLOY_ZIP_NAME:-quests-theme.zip}"

exec "${SCRIPT_DIR}/../tools/deploy.sh" "$@"
