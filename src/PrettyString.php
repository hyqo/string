<?php

namespace Hyqo\String;

class PrettyString
{
    public function __construct(
        private string $text
    ) {
    }

    public function __toString(): string
    {
        return $this->text;
    }

    public function snakeCase(): string
    {
        $this->text = (string)preg_replace('/(?<!^)[A-Z]|(?<=\s)[\w]/', '_$0', $this->text);
        $this->text = strtolower($this->text);

        return $this;
    }

    public function camelCase(): self
    {
        $this->text = (string)preg_replace_callback('/[\s_-]+(\w)/', fn($match) => ucfirst($match[1]), $this->text);
        $this->text = ucfirst($this->text);

        return $this;
    }

    public function lower(): self
    {
        $this->text = strtolower($this->text);

        return $this;
    }

    public function upper(): self
    {
        $this->text = strtoupper($this->text);

        return $this;
    }

    public function upperFirst(): self
    {
        $this->text = ucfirst($this->text);

        return $this;
    }
}
