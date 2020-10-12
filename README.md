# GildedRose Kata - PHP Version

See the [instructions file](../instructions.md) for general information about this exercise. This is the PHP version of the
 GildedRose Kata. 

## Branchs
- master: original code of gildedRose Kata
- stage 0: add tests 
- stage 1: semantic refactoring
- stage 2: applying solid

## Installation

The kata uses:

- PHP 7.2+
- [Composer](https://getcomposer.org)

Recommended:
- [Git](https://git-scm.com/downloads)

Clone the repository

```sh
git clone git@github.com:emilybache/GildedRose-Refactoring-Kata.git
```

or

```shell script
git clone https://github.com/emilybache/GildedRose-Refactoring-Kata.git
```

Install all the dependencies using composer

```shell script
cd ./GildedRose-Refactoring-Kata/php
composer install
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard) 
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki)

## Folders

- `src` - contains the two classes:
  - `Item.php` - this class should not be changed.
  - `GildedRose.php` - this class needs to be refactored, and the new feature added.
- `tests` - contains the tests
  - `GildedRoseTest.php` - Starter test.
  - `ApprovalTest.php` - alternative approval test (set to 30 days)
- `Fixture`
  - `texttest_fixture.php` used by the approval test, or can be run from the command line

## Testing

PHPUnit is pre-configured to run tests. PHPUnit can be run using a composer script. To run the unit tests, from the
 root of the PHP project run:

```shell script
composer test
```

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias pu="composer test"`), the same
 PHPUnit `composer test` can be run:

```shell script
pu
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
composer test-coverage
```

The test-coverage report will be created in /builds, it is best viewed by opening **index.html** in your browser.

## Code Standard

Easy Coding Standard (ECS) is used to check for style and code standards, **PSR-12** is used. The current code is not
 upto standard!

### Check Code

To check code, but not fix errors:

```shell script
composer check-cs
``` 

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias cc="composer check-cs"`), the
 same PHPUnit `composer check-cs` can be run:

```shell script
cc
```

### Fix Code

There are may code fixes automatically provided by ECS, if advised to run --fix, the following script can be run:

```shell script
composer fix-cs
```

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias fc="composer fix-cs"`), the same
 PHPUnit `composer fix-cs` can be run:

```shell script
fc
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
composer phpstan
```

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias ps="composer phpstan"`), the
 same PHPUnit `composer phpstan` can be run:

```shell script
ps
```

**Happy coding**!# kataGildedRoseRefactoring
