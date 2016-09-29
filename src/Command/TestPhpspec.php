<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.09.16
 * Time: 12:46
 */
namespace NonCoupledConsoleApplication\Command;

use NonCoupledConsoleApplication\BaseCommand;

/**
 * Class TestPhpspec
 * @package NonCoupledConsoleApplication\Command
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class TestPhpspec extends BaseCommand
{
    const COMMAND_NAME = 'test_phpsec';

    /**
     * @return mixed
     */
    public function run()
    {
        $this->log(sprintf('Executing %s command', self::COMMAND_NAME));
    }
}
