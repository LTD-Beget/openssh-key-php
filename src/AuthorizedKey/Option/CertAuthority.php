<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class CertAuthority extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'cert-authority';
    }
}
