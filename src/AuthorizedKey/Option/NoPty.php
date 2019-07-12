<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class NoPty extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'no-pty';
    }
}
