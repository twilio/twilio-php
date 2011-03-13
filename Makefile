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

test:
	@echo running tests
	@phpunit --configuration tests/phpunit.xml

.PHONY: all clean dist test
