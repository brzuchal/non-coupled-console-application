<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.09.16
 * Time: 12:40
 */
namespace NonCoupledConsoleApplication;

/**
 * Class MyCommand
 * @package NonCoupledConsoleApplication
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
abstract class BaseCommand
{
    /** @var callable */
    private $logger;

    /**
     * @return mixed
     */
    abstract public function run();

    /**
     * @param string $msg
     */
    public function log(string $msg)
    {
        $this->logger->call($this, $msg);
    }

    /**
     * @param callable $logger
     */
    public function setLogger(callable $logger)
    {
        $this->logger = $logger;
    }
}
