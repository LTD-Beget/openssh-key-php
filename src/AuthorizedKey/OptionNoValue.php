<?php

namespace LTDBeget\openssh\AuthorizedKey;

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
