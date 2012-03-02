#!/bin/bash

pyrus channel-discover pear.survivethedeepend.com
pyrus channel-discover twilio.github.com/pear
pyrus install deepend/Mockery
pyrus install twilio/Services_Twilio --optionaldeps

phpenv rehash

