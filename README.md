<div align="center">

![Magento 2 Easy Template Path Hints](https://i.imgur.com/d8QEHRb.png)
# Magento 2 Easy Template Path Hints

</div>

<div align="center">

[![Packagist Version](https://img.shields.io/packagist/v/magepsycho/magento2-easy-template-path-hints?logo=packagist&style=for-the-badge)](https://packagist.org/packages/magepsycho/magento2-easy-template-path-hints)
[![Packagist Downloads](https://img.shields.io/packagist/dt/magepsycho/magento2-easy-template-path-hints.svg?logo=composer&style=for-the-badge)](https://packagist.org/packages/magepsycho/magento2-easy-template-path-hints/stats)
![Supported Magento Versions](https://img.shields.io/badge/magento-%202.3_|_2.4-brightgreen.svg?logo=magento&longCache=true&style=for-the-badge)
![License](https://img.shields.io/badge/license-MIT-green?color=%23234&style=for-the-badge)

</div>

##  Overview
[Magento 2 Easy Template Path Hints](https://www.magepsycho.com/magento-2-easy-template-path-hints.html) is used to enable the template path hints on the fly just by using query strings.

(This is a ported version of [Easy Template Path Hints - Magento 1](https://github.com/MagePsycho/MagePsycho_Easypathhints) for Magento 2)

## Functionality
* Turn on template path hints on the fly for frontend
* Turn on template path hints on the fly for backend
* Option to configure access code
* Option to save settings in cookie


## Installation

### 1 Using Composer
```
composer require magepsycho/magento2-easy-template-path-hints
```

### 2 Using Modman
```
modman init
modman clone git@github.com:MagePsycho/magento2-easy-template-path-hints.git
```

### 3 Using Zip File
* Download the [Extension Zip File](https://github.com/MagePsycho/magento2-easy-template-path-hints/archive/master.zip)
* Extract & upload the files to `/path/to/magento2/app/code/MagePsycho/Easypathhints/`

After installation by either means, activate the extension with following steps

1. Enable the module
```
php bin/magento module:enable MagePsycho_Easypathhints --clear-static-content
php bin/magento setup:upgrade
```
2. Flush the store cache
```
php bin/magento cache:flush
```
3. Deploy static content - *in Production mode only*
```
rm -rf pub/static/* var/view_preprocessed/*
php bin/magento setup:static-content:deploy
```
4. Go to Admin > STORES > Configuration > MAGEPSYCHO > Easy Template Path Hints > Manage Settings


## Usage

1. Enable template path hints without access code:
    * http://magento-store-url.com/any-page?tp=1

1. Enable template path hints with access code:
    * http://magento-store-url.com/any-page?tp=1&code=access-code

1. Enable template path hints with cookie
    * http://magento-store-url.com/any-page?tp=1&code=your-access-code&cookie=1

## Screenshot
![Backend Settings](https://raw.github.com/MagePsycho/magento2-easy-template-path-hints/master/docs/backend-settings.png "Backend Settings")


![Frontend Demo](https://raw.github.com/MagePsycho/magento2-easy-template-path-hints/master/docs/magento-2-easy-template-path-hints-frontend.png "Frontend Demo")

## Changelog
**Version 1.1.2 (2018-05-10)**
* Fixed wrong module path if installed via composer

**Version 1.1.1 (2018-05-10)**
* Fixed template block class hints not showing

**Version 1.1.0 (2017-06-16)**
* Refactored the code (Logger, Cookie, Config etc.)
* Fixed template path hints not working for Magento versions 2.1.3+

**Version 1.0.2 (2016-04-03)**
* Fixed template path hints for admin.
* Refactored code.

**Version 1.0.1 (2016-04-03)**
* Fixed relative XSD path of xml configurations.
* Added modman file.
* Refactored code.

**Version 1.0.0 (2015-10-30)**
* Initial Release

## Authors
- Raj KB [![Twitter Follow](https://img.shields.io/twitter/follow/rajkbnp.svg?style=social)](https://twitter.com/rajkbnp)

## Contributors

![Contributors](https://contrib.rocks/image?repo=MagePsycho/magento2-easy-template-path-hints)

## To Contribute
Any contribution to the development of `Magento 2 Easy Template Path Hints` is highly welcome.  
The best possibility to provide any code is to open a [pull request on GitHub](https://github.com/MagePsycho/magento2-easy-template-path-hints/pulls).

## Need Support?
If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/MagePsycho/magento2-easy-template-path-hints/issues).

Please [visit our store](https://www.magepsycho.com/extensions/magento-2.html) for more FREE / paid extensions OR [contact us](https://magepsycho.com/contact) for customization / development services.