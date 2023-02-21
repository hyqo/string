# String

![Packagist Version](https://img.shields.io/packagist/v/hyqo/string.svg?style=flat-square)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/hyqo/string?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/hyqo/string/run-tests?style=flat-square&label=tests)

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

Changing writing style also available as functions:

```php
echo CamelCase('foo_bar'); //fooBar
echo snake_case('fooBar'); //foo_bar
echo PascalCase('foo_bar'); //FooBar
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
