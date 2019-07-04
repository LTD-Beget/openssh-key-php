<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionSingle;

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
