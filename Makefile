# Twilio API helper library.
# See LICENSE file for copyright and license details.

all: dist test

dist:
	@echo creating package

test:
	@echo running tests
	@phpunit --configuration tests/phpunit.xml

.PHONY: all dist test
