<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

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
