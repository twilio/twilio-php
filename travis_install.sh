#!/bin/sh

echo `which pyrus`
echo `which pear`

hash pyrus 2>&- || { echo "Pyrus is not installed."; }
hash pear 2>&- || { echo "pear is not installed."; }

hash pyrus 2>&- && {
    pyrus channel-discover pear.survivethedeepend.com
    pyrus channel-discover twilio.github.com/pear
    pyrus install twilio/Services_Twilio --optionaldeps
}

hash pear 2>&- && {
    pear channel-discover pear.survivethedeepend.com
    pear channel-discover twilio.github.com/pear
    pear install twilio/Services_Twilio --alldeps
}

phpenv rehash
