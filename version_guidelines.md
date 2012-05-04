# Bumping versions

Twilio follows the versioning guidelines [here](http://apr.apache.org/versioning.html).

When you are bumping the version number, here is a list of files you need to
update.

* Add a summary of the changes to the CHANGES file in the home directory.

* If necessary, add the contributor to the AUTHORS file.

* Bump the version in the user agent in Services/Twilio.php

* Update the release number in docs/conf.py

* Update the version number in docs/index.rst

* Update the version number in package.php, add a short change note, and then
  run: 
    
        php package.php > package.xml

    You may need to install some dependencies to get this to run properly.
