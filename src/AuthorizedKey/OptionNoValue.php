<?php

namespace OpenSSH\AuthorizedKey;

abstract class OptionNoValue extends Option
{
    /**
     * @return string
     */
    public function toString(): string
    {
        return static::getName();
    }
}
