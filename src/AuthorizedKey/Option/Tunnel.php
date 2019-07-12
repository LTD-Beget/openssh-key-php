<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionSingle;

class Tunnel extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'tunnel';
    }
}
