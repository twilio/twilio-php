# Twilio API helper library.
# See LICENSE file for copyright and license details.

COMPOSER = $(shell which composer)
ifeq ($(strip $(COMPOSER)),)
	COMPOSER = php composer.phar
endif
PHPVERSION = $(shell php -r 'echo PHP_VERSION;')

all: test

clean:
	@rm -rf docs venv vendor composer.lock

install: clean
	@composer --version || (curl -s https://getcomposer.org/installer | php);
	$(COMPOSER) install

vendor: install

test: install
	@PATH=vendor/bin:$(PATH) phpunit --strict-coverage --disallow-test-output --colors --configuration tests/phpunit.xml

docs:
	vendor/bin/apigen generate --source src -d docs/api --exclude="autoload.php" --template-theme bootstrap --main Twilio

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

docker-dev-build:
	-docker stop twilio_php${VERSION}
	-docker rm twilio_php${VERSION}
	docker image build --tag="twilio/php${VERSION}" --build-arg version=${VERSION} -f ./Dockerfile-dev .
	docker run -td --name="twilio_php${VERSION}" --mount type=bind,source=${PWD},target=/twilio twilio/php${VERSION} /bin/bash

docker-dev-clean:
	docker ps --format '{{.Names}}' | grep "^twilio_php" | xargs -I {} sh -c "docker stop {} && docker rm {}" > /dev/null

docker-dev-test:
	docker exec -t twilio_php${VERSION} /bin/bash -c 'make all'

.PHONY: all clean install test docs authors docker-dev-build docker-dev-clean docker-dev-test
