# Twilio API helper library.
# See LICENSE file for copyright and license details.

define LICENSE
<?php

/**
 * Twilio API helper library.
 *
 * @category  Services
 * @package   Services_Twilio
 * @author    Neuman Vong <neuman@twilio.com>
 * @license   http://creativecommons.org/licenses/MIT/ MIT
 * @link      http://pear.php.net/package/Services_Twilio
 */
endef
export LICENSE

all: test

clean:
	@rm -rf dist

PHP_FILES = `find dist -name \*.php`
dist: clean
	@mkdir dist
	@git archive master | (cd dist; tar xf -)
	@for php in $(PHP_FILES); do\
	  echo "$$LICENSE" > $$php.new; \
	  tail -n+2 $$php >> $$php.new; \
	  mv $$php.new $$php; \
	done

# if these fail, you may need to install the helper libraries - see "Running
# Tests" at http://readthedocs.org/projects/twilio-php/.
test:
	@echo running tests
	@phpunit --strict --colors --configuration tests/phpunit.xml

.PHONY: all clean dist test
