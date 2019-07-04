<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

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
