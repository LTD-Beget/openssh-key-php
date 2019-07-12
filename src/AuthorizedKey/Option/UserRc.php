<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class UserRc extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'user-rc';
    }
}
