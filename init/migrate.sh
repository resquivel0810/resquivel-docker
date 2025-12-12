#!/bin/bash
set -e

##############
# migrate.sh #
##############
#
# Safely updates URLs in the database so the site can run on localhost.
# Works whether the DB was freshly created or already existed.
#

export dev_url="http://localhost"

echo "Starting migrate.sh..."

# Detect MySQL root password (fallback to empty)
mysql_password="${MYSQL_ROOT_PASSWORD:-}"

# Test root login with password
if echo "SELECT 1" | mysql -uroot -p"${mysql_password}" >/dev/null 2>&1; then
    echo "Connected using root + password."
    root_auth="-uroot -p${mysql_password}"
else
    # Try without password (for pre-existing DBs)
    if echo "SELECT 1" | mysql -uroot >/dev/null 2>&1; then
        echo "Connected using root WITHOUT password."
        root_auth="-uroot"
    else
        echo "ERROR: Cannot authenticate to MySQL as root."
        echo "Check MYSQL_ROOT_PASSWORD or existing MySQL installation."
        exit 1
    fi
fi

echo "Running URL replacements..."

mysql ${root_auth} -D"${MYSQL_DATABASE}" -e "
UPDATE ${WORDPRESS_TABLE_PREFIX}options 
   SET option_value = '${dev_url}'
 WHERE option_name IN ('home', 'siteurl');

UPDATE ${WORDPRESS_TABLE_PREFIX}posts 
   SET guid = REPLACE(guid, '${PRODUCTION_URL}', '${dev_url}');

UPDATE ${WORDPRESS_TABLE_PREFIX}posts 
   SET post_content = REPLACE(post_content, '${PRODUCTION_URL}', '${dev_url}');

UPDATE ${WORDPRESS_TABLE_PREFIX}posts 
   SET post_content = REPLACE(post_content,
       CONCAT('src=\"', '${PRODUCTION_URL}', '\"'),
       CONCAT('src=\"', '${dev_url}', '\"')
   );

UPDATE ${WORDPRESS_TABLE_PREFIX}posts 
   SET guid = REPLACE(guid, '${PRODUCTION_URL}', '${dev_url}')
 WHERE post_type = 'attachment';

UPDATE ${WORDPRESS_TABLE_PREFIX}postmeta 
   SET meta_value = REPLACE(meta_value, '${PRODUCTION_URL}', '${dev_url}');
"

echo "migrate.sh completed successfully!"