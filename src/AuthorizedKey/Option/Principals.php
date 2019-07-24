<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionSingle;

class Principals extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'principals';
    }
}
