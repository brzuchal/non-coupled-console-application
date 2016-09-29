<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.09.16
 * Time: 12:40
 */
namespace NonCoupledConsoleApplication;

use NonCoupledConsoleApplication\Command\TestPhpspec;
use NonCoupledConsoleApplication\Command\TestPhpunit;

class CommandFactory
{
    /** @var array */
    private static $commands = [
        TestPhpunit::COMMAND_NAME => TestPhpunit::class,
        TestPhpspec::COMMAND_NAME => TestPhpspec::class,
    ];

    /**
     * @param string $type
     * @param bool $compatibilityMode
     * @return BaseCommand
     */
    public function createFrom(string $type, bool $compatibilityMode) : BaseCommand
    {
        if (array_key_exists($type, self::$commands) && class_exists(self::$commands[$type])) {
            $class = self::$commands[$type];
            return new $class($compatibilityMode);
        }

        throw new \RuntimeException("Nie istnieje podany typ komendy: {$type}");
    }

    /**
     * @return array
     */
    public function getCommandNames() : array
    {
        return array_keys(self::$commands);
    }
}
