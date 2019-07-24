<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionSingle;

class Command extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'command';
    }
}
