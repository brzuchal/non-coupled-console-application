<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.09.16
 * Time: 13:03
 */
namespace NonCoupledConsoleApplication;

require __DIR__ . '/../vendor/autoload.php';

$application = new Application("CI", "@git-version@");
$application->run();