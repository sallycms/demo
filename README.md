SallyCMS
========

SallyCMS is a flexible and fast PHP 5.3+ CMS, aimed at professional developers.
It integrates well with [Composer](https://getcomposer.org/) and a good balance
between enterprise frameworks like [Symfony2](http://symfony.com/) (from which
it thankfully adopts some ideas and concepts) and simpler systems like
[REDAXO](http://www.redaxo.org/) (which is where Sally originally forked from
in 2009).

SallyCMS can be used to develop small one-pagers, complex websites or
webservices. The frontend (if any) is completely up to the developer, whereas
the backend is standardized and can easily extended and customized.

* [Documentation](http://docs.webvariants.de/sallycms/latest/index.html)
* [Repository](https://bitbucket.org/SallyCMS/sallycms)
* [Bug Tracker](https://bitbucket.org/SallyCMS/sallycms/issues)

The development is fast paced and aims to release roughly two "main" releases
per year. Because the API and some concepts are not considered stable and can
change heavily between "main" releases, we release major versions as 0.x minor
releases (until we're sure we can support the API for a longer time, at which
we will switch to the regular [semantic versioning](http://semver.org/) scheme).
Bugfix releases occur roughly every month and do not change the API in
incompatible ways (so it's safe and recommended to update projects frequently).

[![Build Status](https://api.travis-ci.org/sallycms/core.png?branch=master)](http://travis-ci.org/sallycms/core)

Requirements
------------

SallyCMS requires PHP 5.3.3, together with MySQL 5.0+ and Apache 2.2+. It's
compatible with PHP up to 5.5, MySQL 5.6 (including MariaDB 5.5) and Apache 2.4.

To install non-stable addOns or SallyCMS versions, you will also need Mercurial
and Git installed on your system.

Installation / Usage
--------------------

You can either use Composer to install SallyCMS (using the standard
distribution) or download a prebuilt
[starterkit](https://bitbucket.org/SallyCMS/sallycms/downloads). But be aware
that sooner or later you will need to use Composer (for example to install
addOns or update SallyCMS), so we strongly recommended starting with the
standard distribution.

1. [Install Composer](http://getcomposer.org/doc/00-intro.md).
2. [Download](https://bitbucket.org/SallyCMS/sallycms/downloads) the standard or
   starterkit distribution. Extract it to your desired location, most likely
   somewhere in your webserver's document root.
3. (Only if using the standard distribution) Install the dependencies using
   Composer: `php composer.phar install`
4. Open the project in your browser: `http://localhost/path/to/sallycms/` You
   will automatically be redirected to the setup application. Finish it to
   start using the backend.
5. Install your required addOns by adding them to the `composer.json`.

Contributing
------------

SallyCMS is an open-source project and welcomes any kind of contribution. If
you'd like to contribute, please read the
[Contributing Code](http://docs.webvariants.de/sallycms/latest/contributing/core.html)
section of the documentation. If you're contribution code, please follow the
[Coding Guidelines](http://docs.webvariants.de/sallycms/latest/contributing/coding-guidelines.html).

Community
---------

The main news channel for SallyCMS is its
[Google+ page](https://plus.google.com/114660281857431220675), where new
releases and development news are announced.

The [forum](https://projects.webvariants.de/projects/sallycms/boards) is located
at the old project hosting website and open to everyone with problems an
suggestions. Please use the
[bug tracker](https://bitbucket.org/SallyCMS/sallycms/issues) if you have found
something broken in SallyCMS.

License
-------

SallyCMS is licensed under the MIT License - see the LICENSE file for details.
