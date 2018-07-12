# Twilio API helper library.
# See LICENSE file for copyright and license details.

COMPOSER = $(shell which composer)
ifeq ($(strip $(COMPOSER)),)
	COMPOSER = php composer.phar
endif

all: test

clean:
	@rm -rf venv vendor

install:
	@composer --version || (echo "Composer is not installed, please install Composer"; exit 1);
	# Composer: http://getcomposer.org/download/
	$(COMPOSER) install

vendor: install

# if these fail, you may need to install the helper library
test: install
	@PATH=vendor/bin:$(PATH) phpunit --report-useless-tests --strict-coverage --disallow-test-output --colors --configuration Twilio/Tests/phpunit.xml
	@PATH=vendor/bin:$(PATH) phpunit --report-useless-tests --strict-coverage --disallow-test-output --colors Services/Tests/TwilioTest.php

docs-install:
	composer require --dev apigen/apigen

docs: docs-install
	vendor/bin/apigen generate -s ./ -d docs/api --exclude="Tests/*" --exclude="vendor/*" --exclude="autoload.php" --template-theme bootstrap --main Twilio

authors:
	echo "Authors\n=======\n\nA huge thanks to all of our contributors:\n\n" > AUTHORS.md
	git log --raw | grep "^Author: " | cut -d ' ' -f2- | cut -d '<' -f1 | sed 's/^/- /' | sort | uniq >> AUTHORS.md

API_DEFINITIONS_SHA=$(shell git log --oneline | grep Regenerated | head -n1 | cut -d ' ' -f 5)
docker-build:
	docker build -t twilio/twilio-php .
	docker tag twilio/twilio-php twilio/twilio-php:${TRAVIS_TAG}
	docker tag twilio/twilio-php twilio/twilio-php:apidefs-${API_DEFINITIONS_SHA}
	docker tag twilio/twilio-php twilio/twilio-php:latest

docker-push:
	echo "${DOCKER_PASSWORD}" | docker login -u "${DOCKER_USERNAME}" --password-stdin
	docker push twilio/twilio-php:${TRAVIS_TAG}
	docker push twilio/twilio-php:apidefs-${API_DEFINITIONS_SHA}
	docker push twilio/twilio-php:latest

.PHONY: all clean test docs docs-install test-install authors
