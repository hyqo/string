# String

![Packagist Version](https://img.shields.io/packagist/v/hyqo/string.svg?style=flat-square)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/hyqo/string?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/hyqo/string/tests.yml?label=tests&style=flat-square)

Fluent-style string operations

## Install

```sh
composer require hyqo/string
```

## Usage

```php
use function Hyqo\String\s;

echo s('FOO BAR')->lower()->upperFirst(); //Foo bar
```

Other functions:
```php
use function Hyqo\String\s;

s('foo#bar')->leftCrop('#'); //bar
s('foo#bar')->rightCrop('#'); //foo

s('foo="bar"')->parseKeyValue(); // ['foo', 'bar']

use function Hyqo\String\SplitFlag;

s('foo, , bar')->split(','); // ['foo', ' ', ' bar']
s('foo, , bar')->split(',', SplitFlag::TRIM_NO_EMPTY); // ['foo', 'bar']
s('foo, , bar')->splitStrictly(','); // ['foo', 'bar']
```
