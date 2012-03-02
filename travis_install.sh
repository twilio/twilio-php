#!/bin/sh

echo `which pyrus`
echo `which pear`

if [ "$TRAVIS_PHP_VERSION" == "5.2" ]; then
    pear channel-discover pear.survivethedeepend.com
    pear channel-discover twilio.github.com/pear
    pear install --alldeps twilio/Services_Twilio
else
    pyrus channel-discover pear.survivethedeepend.com
    pyrus channel-discover twilio.github.com/pear
    pyrus install twilio/Services_Twilio --optionaldeps
fi

phpenv rehash

