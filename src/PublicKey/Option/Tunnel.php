<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionSingle;

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
