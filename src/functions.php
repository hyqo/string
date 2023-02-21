<?php

namespace Hyqo\String;

function s(string $string): PrettyString
{
    return new PrettyString($string);
}
