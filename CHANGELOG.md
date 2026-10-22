# Changelog: Product Page PDF for Magento 1 / OpenMage

All releases of this extension, newest first. This repository contains the latest release, tagged [`2.6.0`](https://github.com/PluginCompany/magento1-product-page-pdf/releases/tag/2.6.0); earlier versions are listed for reference and have no tag.

*Unreleased* changes are commits on `main` after the `2.6.0` tag; they are not part of a tagged release.

## Unreleased — 2026-10-23

- Security hardening: removed standalone mPDF scripts that the extension does not use (lib/PC_Mpdf6.1/compress.php, includes/out.php, utils/, tests/, phpunit.xml). On web servers that ignore Magento's lib/.htaccess (e.g. nginx) they could be called directly.

## 2.6.0 — 2019-08-01

- New option to directly display a print window in the browser when a PDF is opened
- Added CSS color highlighting to Icon and Link CSS fields in system configuration
- Added fallback methods for Google Fonts installation in case initial install fails

## 2.5.4 — 2019-07-07

- Fixed headers already sent message in debug log
- Removed barcode files from mPDF library for Magento Marketplace package support

## 2.5.3 — 2019-05-24

- Fixed missing link text when icon is used for PDF print-out link

## 2.5.2 — 2019-02-28

- Updated translation csv file: File now includes all translatable strings

## 2.5.1 — 2018-09-26

- Added option to set the amount of images to show in the media gallery section
- Improved duplicate image filter accuracy for similar images with different color

## 2.4.0 — 2018-09-15

- Added custom CSS section in system configuration, allowing fine tuning of PDF style more easily
- Fixed some PHP strict mode notice level errors

## 2.3.1 — 2018-07-09

- Fallback to font package extraction using shell command if extraction using PharData class fails

## 2.3.0 — 2018-05-23

- New feature which adds a "Download PDF" button on admin panel product view pages
- Hide empty attributes fix for dropdown attributes still showing in some cases

## 2.2.1 — 2018-05-05

- Fixed potential bug related to attributes PDF section

## 2.2.0 — 2018-05-01

- New system config option to show / hide price per section
- Fixed issue where empty dropdown attribute values weren't hidden when 'hide empty attributes' is enabled
- Some code refactoring / improvements
- Improved system.xml descriptions

## 2.1.3 — 2018-04-17

- Changed toArray method parameters in source models to match Varien_Object. Needed for PHP 7 compatibility.

## 2.1.2 — 2018-03-30

- Removed yellow pop-up text when hovering link in PDF file

## 2.1.1 — 2018-03-28

- PHP 5.3 compatibility fix
- Fixed warning level error regarding media gallery

## 2.1.0 — 2018-02-27

- New option to hide empty attributes in additional information section

## 2.0.4 — 2017-12-29

- Added preference for curl over socket connection for images in mPDF library

## 2.0.3 — 2017-12-04

- Compilation issue fix
- Moved MPDF library to lib directory

## 2.0.2 — 2017-11-21

- Fix for placeholder error when no base image is set for product
- Moved other ttfonts to github

## 2.0.1 — 2017-11-06

- Moved fonts outside of downloadable package. Fonts are now downloaded from GitHub mirror during installation.
- Code style improvements

## 2.0.0 — 2017-10-01

- Completely revamped design
- Refactored / improved code base for easy customization
- Added 40 Google Fonts
- Added option to use custom font family per product page section
- Added option to sort product page sections using drag and drop system
- Added option to display each product page section on new page
- Added 7 media gallery designs
- Added configurable child image support
- Added automatic duplicate image filter
- Added Grouped Product support

## 1.1.7 — 2017-04-10

- Fixed URL encoding issue when product name contains forward slashes

## 1.1.6 — 2017-03-22

- Fixed image overlapping bug

## 1.1.5 — 2017-03-22

- If product has only one image it's now centered

## 1.1.4 — 2017-03-21

- Fixed single quote in product name PDF link bug

## 1.1.3 — 2017-03-06

- Added HTML support for description
- Fixed page break issue for long description

## 1.1.2 — 2017-03-02

- Added translation csv file
- Fixed translation of footer timestamp

## 1.1.1 — 2017-03-02

- Fixed blank page issue

## 1.0.1 — 2016-02-24

- Fixed compatibility with PHP 5.3.x

## 1.0.0 — 2015-12-05

- First release of Magento Product Page PDF extension by Plugin Company.
