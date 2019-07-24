<?php

namespace LTDBeget\openssh\AuthorizedKey;

abstract class Option
{
    /**
     * @param Options $options
     * @return static|null
     */
    public static function from(Options $options)
    {
        return $options->get(static::getName());
    }

    /**
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * @return string
     */
    abstract public function toString(): string;

    /**
     * @return \Closure
     */
    protected function getKeyValueSerializer(): \Closure
    {
        return function (string $value): string {
            return implode('=', [static::getName(), $this->quote($value)]);
        };
    }

    /**
     * @param string $value
     * @return string
     */
    private function quote(string $value): string
    {
        return sprintf('"%s"', strtr($value, ['"' => '\"', '\\' => '\\\\']));
    }
}
