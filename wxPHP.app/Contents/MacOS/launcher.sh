#!/bin/bash

#
# On this file you can write the stub code needed to initialize
# your application like for example:
#
# 1. php/bin/php -d extension=wxwidgets.so app.php
# 2. php/bin/php -d extension=wxwidgets.so myapp/app.phar
#
# The following is the default stub code required to 
# initialize a wxphp terminal session.
#

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

${CURRENT_DIR}/php/bin/php \
-d extension=${CURRENT_DIR}/php/lib/php/extensions/no-debug-zts-20121212/wxwidgets.so \
-d zend_extension=${CURRENT_DIR}/php/lib/php/extensions/no-debug-zts-20121212/opcache.so \
${CURRENT_DIR}/../src/index.php
