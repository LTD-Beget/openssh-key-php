<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class Pty extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'pty';
    }
}
