<?php

namespace Hyqo\String;

use JetBrains\PhpStorm\Pure;

#[Pure]
function s(string $string): PrettyString
{
    return new PrettyString($string);
}

function snake_case(string $string): string
{
    return s($string)->snakeCase();
}

function CamelCase(string $string): string
{
    return s($string)->camelCase();
}
