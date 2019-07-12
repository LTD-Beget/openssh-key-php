<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionRepeated;

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
