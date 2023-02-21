<?php

namespace Hyqo\String;

use JetBrains\PhpStorm\ExpectedValues;

class PrettyString
{
    public function __construct(private string $text)
    {
    }

    public function __toString(): string
    {
        return $this->text;
    }

    public function snakeCase(string $delimiter = '_', bool $upper = false): static
    {
        $this->text = (string)preg_replace(
            ['/(?<!^)[A-Z]|(?<=\s|-)\w/', '/[\s-]+/'],
            [$delimiter . '$0', ''],
            $this->text
        );
        return $upper ? $this->upper() : $this->lower();
    }

    public function camelCase(string $delimiter = ''): static
    {
        $this->lower();

        $this->text = (string)preg_replace_callback(
            '/[\s_-]+(\w)/',
            static function ($match) use ($delimiter) {
                return $delimiter . ucfirst($match[1]);
            },
            $this->text
        );
        return $this;
    }

    public function pascalCase(string $delimiter = ''): static
    {
        $this->text = $this->camelCase($delimiter)->upperFirst();

        return $this;
    }

    public function pregReplace(array|string $pattern, array|string $replacement): static
    {
        $this->text = (string)preg_replace($pattern, $replacement, $this->text);

        return $this;
    }

    public function lower(): static
    {
        $this->text = strtolower($this->text);

        return $this;
    }

    public function upper(): static
    {
        $this->text = strtoupper($this->text);

        return $this;
    }

    public function upperFirst(): static
    {
        $this->text = ucfirst($this->text);

        return $this;
    }

    public function leftCrop(string $marker): static
    {
        if (false !== $pos = strpos($this->text, $marker)) {
            $this->text = substr($this->text, $pos + strlen($marker));
        }

        return $this;
    }

    public function rightCrop(string $marker): static
    {
        if (false !== $pos = strpos($this->text, $marker)) {
            $this->text = substr($this->text, 0, $pos);
        }

        return $this;
    }

    public function split(string $delimiter, #[ExpectedValues(flagsFromClass: SplitFlag::class)] int $flags = 0): array
    {
        $parts = explode($delimiter, $this->text);

        if (SplitFlag::TRIM & $flags) {
            $parts = array_map(static fn(string $part) => trim($part), $parts);
        }

        if (SplitFlag::NO_EMPTY & $flags) {
            $parts = array_filter($parts, static fn(string $part) => (bool)$part);
        }

        return array_values($parts);
    }

    public function splitStrictly(string $delimiter): array
    {
        return $this->split($delimiter, SplitFlag::TRIM | SplitFlag::NO_EMPTY);
    }
}
