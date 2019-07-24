<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionSingle;

class ExpiryTime extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'expiry-time';
    }
}
