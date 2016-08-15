# Versioning Strategy

`twilio-php` uses [Semantic Versioning][semver] for all changes to the helper 
library.  It is strongly encouraged that you pin at least the major version to 
avoid pulling in breaking changes.

Semantic Versions take the form of `MAJOR`.`MINOR`.`PATCH`

When bugs are fixed in the library in a backwards compatible way, the `PATCH` 
level will be incremented by one.  `PATCH` changes should _not_ break your code 
and are generally safe to upgrade to.

When new features are added to the library in a backwards compatible way, the 
`MINOR` level will be incremented by one and the `PATCH` level will be reset to
zero.  `MINOR` changes are should _not_ break your code and are generally safe
to upgrade to.  After a `MINOR` change you may wish to review the helper library
for new features and functionality.

When a bug or feature requires a breaking change, the `MAJOR` level will be 
incremented by one and the `MINOR` and `PATCH` levels will reset to zero.  These
changes can break your code.  Twilio understands that this can be very 
disruptive, we will only introduce breaking changes when absolutely necessary. 
Breaking changes will be communicated in advance with `Release Candidates` and a
schedule.

## Supported Versions

`twilio-php` follows an evergreen model of support.  New features and 
functionality will only be added to the current version.  The current version - 
1 will continue to be supported with bugfixes and security updates, but no new 
features.

## Edge Features (Alpha Branch)

Twilio frequently rolls out new features in public and private beta periods.
Twilio strives to ship early and often and bake customer feedback back into our 
products.  To support that mission, the `twilio-php` helper library has an 
`Edge` version based of the `alpha` branch.  This version is identified with an
`alpha` metadata tag on the version number.

The way the `Edge` artifact is created is by playing the `Edge` features on top
of our stable artifact.  The `Edge` artifact will always have the same version 
number as the stable artifact it was created from, but with an `alpha` suffix.

For example, `5.0.1-alpha1` is the `5.0.1` branch with `Edge` features included.
If there is a change to one of the `Edge` features we may regenerate the `Edge`
artifact and release a new `5.0.1-alpha2`, new `Edge` artifacts simply increment
the number after the `alpha` suffix.  All `Edge` features are considered 
unstable and a backwards incompatible change in an `Edge` feature will not cause
any version change so you should take care when upgrading from one `alpha` 
version to another.  

Once an `Edge` feature has matured it will be considered `Mainline` and included
in the stable artifact, with a `MAJOR` or `MINOR` version bump.

To use an `Edge` artifact in your PHP project you will have to make sure that 
you pin the artifact with `alpha` stability in your package.json.

[semver]: http://semver.org/