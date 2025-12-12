#!/bin/bash
set -e

###############
# Safe prep.sh
###############
#
# What this script does:
# 1. Disables plugins listed in $DISABLED_PLUGINS by renaming folders.
# 2. Safely fixes wp-content permissions using chmod (NOT chown).
#    - Works on macOS/Windows (Docker Desktop) where chown fails.
#    - Skips .git directories to avoid breaking Git repos.
#

wp_content_path="/var/www/html/wp-content"
wp_plugins_path="${wp_content_path}/plugins"

echo "Running prep.sh..."

###############################
# 1. Disable requested plugins
###############################
if [ -z "$DISABLED_PLUGINS" ]; then
    echo "No plugins to disable. Skipping..."
else
    IFS=',' read -ra plugin_arr <<< "$DISABLED_PLUGINS"

    for plugin in "${plugin_arr[@]}"; do
        src="${wp_plugins_path}/${plugin}"
        dst="${wp_plugins_path}/${plugin}_DISABLED"

        echo "Attempting to disable plugin: $plugin"

        if [ -d "$dst" ]; then
            echo "➜ $plugin is already disabled. Skipping."
        elif [ -d "$src" ]; then
            mv "$src" "$dst"
            echo "✓ Disabled $plugin"
        else
            echo "✗ Plugin '$plugin' does not exist."
        fi
    done
fi


###############################################
# 2. Fix permissions safely (NO CHOWN EVER)
###############################################

echo "Fixing safe permissions on wp-content (chmod only)..."
echo "This avoids Docker Desktop chown issues and preserves Git repos."

# find all files/dirs except .git folders
find "$wp_content_path" \
  -path "/.git" -prune -o \
  -type d -exec chmod 775 {} \; -o \
  -type f -exec chmod 664 {} \;

echo "✓ Permissions applied safely."
echo "prep.sh completed!"