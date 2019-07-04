<?php

namespace OpenSSH\PublicKey;

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
