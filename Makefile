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
	@rm -rf dist venv

PHP_FILES = `find dist -name \*.php`
dist: clean
	@mkdir dist
	@git archive master | (cd dist; tar xf -)
	@for php in $(PHP_FILES); do\
	  echo "$$LICENSE" > $$php.new; \
	  tail -n+2 $$php >> $$php.new; \
	  mv $$php.new $$php; \
	done

test-install:
	-pear channel-discover pear.phpunit.de
	-pear channel-discover components.ez.no
	-pear channel-discover pear.symfony-project.com
	-pear channel-discover pear.survivethedeepend.com
	-pear channel-discover hamcrest.googlecode.com/svn/pear
	-pear install --alldeps deepend/Mockery
	-pear install phpunit/PHPUnit

install:
	pear channel-discover twilio.github.com/pear
	pear install twilio/Services_Twilio

# if these fail, you may need to install the helper libraries - see "Running
# Tests" at http://readthedocs.org/projects/twilio-php/.
test:
	phpunit --strict --colors --configuration tests/phpunit.xml

venv:
	virtualenv venv

docs-install: venv
	. venv/bin/activate; pip install -r docs/requirements.txt

docs:
	. venv/bin/activate; cd docs && make html

authors:
	echo "Authors\n=======\n\nA huge thanks to all of our contributors:\n\n" > AUTHORS.md
	git log --raw | grep "^Author: " | cut -d ' ' -f2- | cut -d '<' -f1 | sed 's/^/- /' | sort | uniq >> AUTHORS.md

.PHONY: all clean dist test docs docs-install test-install authors
