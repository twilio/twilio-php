#!/bin/sh

hash pyrus 2>&- && {
    pyrus channel-discover twilio.github.com/pear
    pyrus install twilio/Services_Twilio --optionaldeps
}

hash pear 2>&- && {
    pear channel-discover twilio.github.com/pear
    pear install twilio/Services_Twilio --optionaldeps
}
