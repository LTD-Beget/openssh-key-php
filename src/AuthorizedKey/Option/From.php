<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionSingle;

class From extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'from';
    }
}
