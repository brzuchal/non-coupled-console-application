<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.09.16
 * Time: 12:45
 */
namespace NonCoupledConsoleApplication\Command;

use NonCoupledConsoleApplication\BaseCommand;

/**
 * Class TestPhpunit
 * @package NonCoupledConsoleApplication\Command
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class TestPhpunit extends BaseCommand
{
    const COMMAND_NAME = 'test_phpunit';

    /**
     * @return mixed
     */
    public function run()
    {
        $this->log(sprintf('Executing %s command', self::COMMAND_NAME));
    }
}
