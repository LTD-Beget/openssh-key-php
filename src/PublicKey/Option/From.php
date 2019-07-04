<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionSingle;

class From extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'from';
    }
}
