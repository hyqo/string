# String 

[![Packagist Version](https://img.shields.io/packagist/v/hyqo/string)](https://packagist.org/packages/hyqo/string)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/hyqo/string)

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
use function Hyqo\String\CamelCase;
use function Hyqo\String\snake_case;

echo CamelCase('foo_bar'); //FooBar
echo snake_case('fooBar'); //foo_bar
```
