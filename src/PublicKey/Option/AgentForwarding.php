<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

class AgentForwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'agent-forwarding';
    }
}
