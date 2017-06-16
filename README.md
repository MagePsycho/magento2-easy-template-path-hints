# Magento 2 Easy Template Path Hints

##  Overview

This is an ported version of [Easy Template Path Hints - Magento 1](https://github.com/MagePsycho/MagePsycho_Easypathhints) for Magento 2

It is used to enable the template path hints on the fly just by using query strings.

## Functionality
* Turn on template path hints on the fly for frontend
* Turn on template path hints on the fly for backend
* Option to configure access code
* Option to save settings in cookie


## Installation

### 1 Using Composer
```
composer config repositories.magepsychotemplatehints git git@github.com:MagePsycho/magento2-easy-template-path-hints
composer require magepsycho/magento2-easy-template-path-hints:dev-master
```

### 2 Using Modman
```
modman init
modman clone git@github.com:MagePsycho/magento2-easy-template-path-hints.git
```

### 3 Using Zip File
* Download the [Extension Zip File](https://github.com/MagePsycho/magento2-easy-template-path-hints/archive/master.zip)
* Extract & upload the files to `/path/to/magento2/app/code/MagePsycho/Easypathhints/`

After installation by either means, enable the extension by running following commands (from root of Magento2 installation):
```
php bin/magento module:enable MagePsycho_Easypathhints --clear-static-content
php bin/magento setup:upgrade`
php bin/magento cache:flush
```
[Click here to read more on module packaging, installation & activation in Magento 2](http://www.blog.magepsycho.com/install-magento-2-module-from-github-or-bitbucket-repository-using-composer/)


## Usage

1. Enable template path hints without access code:
    * http://magento-store-url.com/any-page?tp=1

1. Enable template path hints with access code:
    * http://magento-store-url.com/any-page?tp=1&code=access-code

1. Enable template path hints with cookie
    * http://magento-store-url.com/any-page?tp=1&code=your-access-code&cookie=1

Screenshot
-----------
![Backend Settings](https://raw.github.com/MagePsycho/magento2-easy-template-path-hints/master/docs/backend-settings.png "Backend Settings")

Changelog
-------------
**Version 1.1.0 (2017-06-16)**
* Refactored the code (Logger, Cookie etc.)
* Fixed template path hints not working for Magento versions 2.1.3+

**Version 1.0.1 (2016-04-03)**
* Formatted code as per Code Sniffer
* Acl implementation, removal of relative xsd path etc.

**Version 1.0.0 (2015-10-30)**
* Initial Release

Support
-------------
If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/MagePsycho/magento2-easy-template-path-hints/issues).

Contribution
-------------
Any contribution to the development of Easy Template Path Hints is highly welcome. The best possibility to provide any code is to open a [pull request on GitHub](https://github.com/MagePsycho/magento2-easy-template-path-hints/pulls).

Licence
-------
[Open Software License (OSL 3.0)](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2015 Raj KB
