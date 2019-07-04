<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionRepeated;

class PermitOpen extends OptionRepeated
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'permitopen';
    }
}
