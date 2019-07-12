<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionRepeated;

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
