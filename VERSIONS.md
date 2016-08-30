# Versioning Strategy

`twilio-php` uses a modified version of [Semantic Versioning][semver] for all 
changes to the helper library.  It is strongly encouraged that you pin at least 
the major version and potentially the minor version to avoid pulling in breaking 
changes.

Semantic Versions take the form of `MAJOR`.`MINOR`.`PATCH`

When bugs are fixed in the library in a backwards compatible way, the `PATCH` 
level will be incremented by one.  When new features are added to the library 
in a backwards compatible way, the `PATCH` level will be incremented by one.
`PATCH` changes should _not_ break your code and are generally safe for upgrade.

When a new large feature set comes online or a small breaking change is 
introduced, the `MINOR` version will be incremented by one and the `PATCH` 
version reset to zero. `MINOR` changes _may_ require some amount of manual code
change for upgrade, guidance will be provided in the [Upgrade Guide][upgrade]. 
These backwards-incompatible changes will generally be limited to a small number 
of function signature changes.

The `MAJOR` version is used to indicate the family of technology represented by 
the helper library.  It increased from `4.x.x` to `5.x.x` when Twilio moved to 
auto generation of helper libraries.  Breaking changes that requires extensive 
reworking of code (like the `4.x.x` to `5.x.x` upgrade) will case the `MAJOR` 
version to be incremented by one, the `MINOR` and `PATCH` versions will be reset 
to zero.  Twilio understands that this can be very disruptive, we will only 
introduce this type of breaking change when absolutely necessary. New `MAJOR` 
versions will be communicated in advance with `Release Candidates` and a 
schedule.

## Change Logs

Twilio maintains a comprehensive [Changelog][changelog] for every version that 
is released.  This will contain useful information every new version and what 
bugs have been fixed, features added, and functionality enhanced.  After 5.1.1 
Twilio will maintain an [Upgrade Guide][upgrade] for every change (`MINOR` or 
`MAJOR`) that requires changes to your code.  When upgrading between two 
versions that have more than a `PATCH` level change, it's best practice to check
the [Upgrade Guide][upgrade] and to make sure that all your tests and static 
checks pass after upgrade.

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
[changelog]: https://github.com/twilio/twilio-php/blob/master/CHANGES.md
[upgrade]: https://github.com/twilio/twilio-php/blob/master/UPGRADE.md