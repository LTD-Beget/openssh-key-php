<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

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
