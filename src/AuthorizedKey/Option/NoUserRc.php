<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class NoUserRc extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'no-user-rc';
    }
}
