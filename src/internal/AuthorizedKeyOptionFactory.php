<?php

namespace LTDBeget\openssh\internal;

use LTDBeget\openssh\AuthorizedKey\Option;
use LTDBeget\openssh\exceptions\MalformedKeyException;

final class AuthorizedKeyOptionFactory
{
    /** @var string[] */
    private static $optionClasses = [
        Option\AgentForwarding::class,
        Option\CertAuthority::class,
        Option\Command::class,
        Option\Environment::class,
        Option\ExpiryTime::class,
        Option\From::class,
        Option\NoAgentForwarding::class,
        Option\NoPortForwarding::class,
        Option\NoPty::class,
        Option\NoUserRc::class,
        Option\NoX11Forwarding::class,
        Option\PermitListen::class,
        Option\PermitOpen::class,
        Option\PortForwarding::class,
        Option\Principals::class,
        Option\Pty::class,
        Option\Restrict::class,
        Option\Tunnel::class,
        Option\UserRc::class,
        Option\X11Forwarding::class,
    ];
    /** @var string[] */
    private static $optionNameToOptionClass;

    /**
     * @param string $name
     * @return Option
     * @throws MalformedKeyException
     */
    public static function createOptionByName(string $name): Option
    {
        $optionClass = self::getOptionNameToOptionClassMapping()[$name] ?? null;

        if ($optionClass === null) {
            throw new MalformedKeyException("Unknown option name '$name'");
        }

        return new $optionClass();
    }

    /**
     * @return string[]
     */
    private static function getOptionNameToOptionClassMapping(): array
    {
        if (self::$optionNameToOptionClass === null) {
            $optionNames = array_map(function (string $optionClass): string {
                /** @var Option $optionClass */
                return call_user_func([$optionClass, 'getName']);
            }, self::$optionClasses);

            self::$optionNameToOptionClass = array_combine($optionNames, self::$optionClasses);
        }

        return self::$optionNameToOptionClass;
    }
}
