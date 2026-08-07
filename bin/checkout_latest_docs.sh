#!/bin/bash

# Pulls the documentation markdown into resources/docs/<version>.
#
# The content is authored in the laravel-zero/docs repository and is not
# committed here — this site is only the renderer. Run this after cloning
# the project and again whenever you want to pick up upstream changes.

set -euo pipefail

cd "$(dirname "$0")/.."

DOCS_VERSIONS=(
  master
)

for v in "${DOCS_VERSIONS[@]}"; do
    if [ -d "resources/docs/$v/.git" ]; then
        echo "Pulling latest documentation updates for $v..."
        (cd "resources/docs/$v" && git pull --ff-only)
    else
        echo "Cloning $v..."
        rm -rf "resources/docs/$v"
        git clone --single-branch --branch "$v" https://github.com/laravel-zero/docs "resources/docs/$v"
    fi
done
