<?php

namespace OpenSSH\internal;

use OpenSSH\exceptions\MalformedKeyException;
use OpenSSH\PublicKey\Option;

trait PublicKeyOptionFactory
{
    /**
     * @param string $name
     * @return Option
     * @throws MalformedKeyException
     */
    private static function createOptionByName(string $name): Option
    {
        switch ($name) {
            case Option\AgentForwarding::getName():
                return new Option\AgentForwarding();
            case Option\CertAuthority::getName():
                return new Option\CertAuthority();
            case Option\Command::getName():
                return new Option\Command();
            case Option\Environment::getName():
                return new Option\Environment();
            case Option\ExpiryTime::getName():
                return new Option\ExpiryTime();
            case Option\From::getName():
                return new Option\From();
            case Option\NoAgentForwarding::getName():
                return new Option\NoAgentForwarding();
            case Option\NoPortForwarding::getName():
                return new Option\NoPortForwarding();
            case Option\NoPty::getName():
                return new Option\NoPty();
            case Option\NoUserRc::getName():
                return new Option\NoUserRc();
            case Option\NoX11Forwarding::getName():
                return new Option\NoX11Forwarding();
            case Option\PermitListen::getName():
                return new Option\PermitListen();
            case Option\PermitOpen::getName():
                return new Option\PermitOpen();
            case Option\PortForwarding::getName():
                return new Option\PortForwarding();
            case Option\Principals::getName():
                return new Option\Principals();
            case Option\Pty::getName():
                return new Option\Pty();
            case Option\Restrict::getName():
                return new Option\Restrict();
            case Option\Tunnel::getName():
                return new Option\Tunnel();
            case Option\UserRc::getName():
                return new Option\UserRc();
            case Option\X11Forwarding::getName():
                return new Option\X11Forwarding();
        }

        throw new MalformedKeyException("Unknown option name '$name'");
    }
}
