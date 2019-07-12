<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionSingle;

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
