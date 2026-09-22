#!/usr/bin/env bash

set -euo pipefail

REPO_ROOT="/var/www/u0556989/data/repos/best-expert-web"
PROD_ROOT="/var/www/u0556989/data/www/best-expert.pro"

DRY_RUN=""

if [[ "${1:-}" == "--dry-run" ]]; then
    DRY_RUN="--dry-run"
elif [[ -n "${1:-}" ]]; then
    echo "Usage: $0 [--dry-run]"
    exit 1
fi

cd "$REPO_ROOT"

CURRENT_BRANCH="$(git branch --show-current)"

if [[ "$CURRENT_BRANCH" != "main" ]]; then
    echo "ERROR: production deploy is allowed only from main."
    echo "Current branch: $CURRENT_BRANCH"
    exit 1
fi

if [[ -n "$(git status --porcelain)" ]]; then
    echo "ERROR: repository has uncommitted changes."
    echo "Commit or discard them before deployment."
    exit 1
fi

echo "Deploying commit:"
git log -1 --oneline

if [[ -n "$DRY_RUN" ]]; then
    echo
    echo "=== DRY RUN MODE ==="
fi

echo
echo "=== best-expert.pro ==="

rsync -avh --checksum $DRY_RUN \
    --delete \
    --exclude='.git/' \
    --exclude='.gitignore' \
    --exclude='README.md' \
    --exclude='deploy/' \
    --exclude='.DS_Store' \
    --exclude='bitrix/' \
    --exclude='upload/' \
    --exclude='marketplace/' \
    --exclude='favicon.ico' \
    --exclude='yandex_*.html' \
    "$REPO_ROOT/" \
    "$PROD_ROOT/"

echo
echo "=== DEPLOY FINISHED ==="
