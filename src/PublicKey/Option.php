<?php

namespace OpenSSH\PublicKey;

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
}
