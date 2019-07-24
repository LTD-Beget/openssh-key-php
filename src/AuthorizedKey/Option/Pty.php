<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionNoValue;

class Pty extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'pty';
    }
}
