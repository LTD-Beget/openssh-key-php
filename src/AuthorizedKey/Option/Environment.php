<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionRepeated;

class Environment extends OptionRepeated
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'environment';
    }
}
