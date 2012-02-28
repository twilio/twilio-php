#!/bin/sh

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
