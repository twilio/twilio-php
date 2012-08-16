#!/bin/bash

# A setup script for installing the unit test dependencies

pyrus channel-discover pear.survivethedeepend.com
pyrus install deepend/Mockery

phpenv rehash

