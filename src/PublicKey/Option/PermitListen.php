<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionRepeated;

class PermitListen extends OptionRepeated
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'permitlisten';
    }
}
