<?php

use Hyqo\String\SplitFlag;
use PHPUnit\Framework\TestCase;

use function Hyqo\String\s;

class PrettyStringTest extends TestCase
{

    public function testLower(): void
    {
        $this->assertEquals('foo', s('FOO')->lower());
    }

    public function testUpperFirst(): void
    {
        $this->assertEquals('Foo', s('foo')->upperFirst());
    }

    public function testUpper(): void
    {
        $this->assertEquals('FOO', s('fOO')->upper());
    }

    public function testSnakeCase(): void
    {
        $this->assertEquals('foo_bar', s('foo  Bar')->snakeCase());
        $this->assertEquals('foo_bar', s('fooBar')->snakeCase());
        $this->assertEquals('foo+bar', s('fooBar')->snakeCase('+'));
        $this->assertEquals('foo+bar', s('foo-bar')->snakeCase('+'));
        $this->assertEquals('FOO+BAR', s('foo-bar')->snakeCase('+', true));
    }

    public function testCamelCase(): void
    {
        $this->assertEquals('fooBar', s('foo_bar')->camelCase());
        $this->assertEquals('fooBar', s('FOO-BAR')->camelCase());
        $this->assertEquals('foo-Bar', s('foo_bar')->camelCase('-'));
    }

    public function testPascalCase(): void
    {
        $this->assertEquals('FooBar', s('foo_bar')->pascalCase());
        $this->assertEquals('Foo-Bar', s('foo_bar')->pascalCase('-'));
    }

    public function testPregReplace(): void
    {
        $result = (string)s('Foo\BarBaz')
            ->pregReplace([
                '/\\\\([A-Z])/',
                '/(?<=[a-z])([A-Z])/',
            ], [
                ':$1',
                '-$1'
            ])->lower();

        $this->assertEquals('foo:bar-baz', $result);
    }

    public function test_left_crop(): void
    {
        $this->assertEquals('bar', s('foo#bar')->leftCrop('#'));
        $this->assertEquals('bar', s('foo##bar')->leftCrop('##'));
        $this->assertEquals('foo bar', s('foo bar')->leftCrop('#'));
    }

    public function test_right_crop(): void
    {
        $this->assertEquals('foo', s('foo#bar')->rightCrop('#'));
        $this->assertEquals('foo', s('foo##bar')->rightCrop('##'));
        $this->assertEquals('foo bar', s('foo bar')->rightCrop('#'));
    }

    public function test_split(): void
    {
        $this->assertEquals([], s('')->split(' ', SplitFlag::NO_EMPTY));
        $this->assertEquals(['foo', 'bar'], s('foo bar')->split(' '));
        $this->assertEquals(['foo', 'bar'], s('foo,bar')->split(',', SplitFlag::NO_EMPTY));
        $this->assertEquals(['foo', 'bar'], s('foo, , bar')->split(',', SplitFlag::NO_EMPTY | SplitFlag::TRIM));
        $this->assertEquals(['foo', 'bar'], s('foo, , bar')->splitStrictly(','));
    }
}
