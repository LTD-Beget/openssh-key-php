<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionNoValue;

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
