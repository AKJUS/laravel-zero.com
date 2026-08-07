#!/bin/bash

# Renders the social card and the favicon set from resources/og into public/.
#
# The sources are plain HTML so the card stays in step with the landing page:
# same mark, same type, same tokens. Everything is rendered oversized through
# headless Chrome and resampled down, which is what keeps the small sizes and
# the 1200x630 card crisp. Run this after changing the mark or the hero copy.

set -euo pipefail

cd "$(dirname "$0")/.."

CHROME="${CHROME:-/Applications/Google Chrome.app/Contents/MacOS/Google Chrome}"

if [ ! -x "$CHROME" ]; then
    echo "Chrome not found at $CHROME. Set CHROME to override." >&2
    exit 1
fi

WORK="$(mktemp -d)"
trap 'rm -rf "$WORK"' EXIT

shot() {
    "$CHROME" --headless --disable-gpu --hide-scrollbars \
        --force-device-scale-factor="$1" \
        --window-size="$2,$3" \
        --virtual-time-budget=6000 \
        --screenshot="$4" \
        "file://$(pwd)/$5" >/dev/null 2>&1
}

resize() {
    cp "$1" "$3"
    sips -z "$2" "$2" "$3" >/dev/null
}

echo "Rendering the social card..."
shot 2 1200 630 "$WORK/og.png" resources/og/card.html
sips -z 630 1200 "$WORK/og.png" >/dev/null
cp "$WORK/og.png" public/og.png

echo "Rendering the icons..."
shot 4 512 512 "$WORK/icon.png" resources/og/icon.html

resize "$WORK/icon.png" 512 public/icon-512.png
resize "$WORK/icon.png" 192 public/icon-192.png
resize "$WORK/icon.png" 180 public/apple-touch-icon.png
resize "$WORK/icon.png" 32 "$WORK/icon-32.png"
resize "$WORK/icon.png" 16 "$WORK/icon-16.png"

echo "Packing favicon.ico..."
php -r '
$work = $argv[1];

// A Vista-era ICO: the directory points straight at embedded PNG payloads,
// which every browser in use understands and keeps the file tiny.
$images = [16 => "$work/icon-16.png", 32 => "$work/icon-32.png"];

$directory = pack("vvv", 0, 1, count($images));
$offset = 6 + 16 * count($images);
$blobs = [];

foreach ($images as $size => $file) {
    $data = file_get_contents($file);
    $directory .= pack("CCCCvvVV", $size, $size, 0, 0, 1, 32, strlen($data), $offset);
    $offset += strlen($data);
    $blobs[] = $data;
}

file_put_contents("public/favicon.ico", $directory . implode("", $blobs));
' "$WORK"

echo "Done."
