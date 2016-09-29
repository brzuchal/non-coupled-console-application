<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.09.16
 * Time: 12:39
 */
namespace NonCoupledConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Application
 * @package NonCoupledConsoleApplication
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Application extends \Symfony\Component\Console\Application
{
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $compatibilityModeOption = new InputOption(
            'compatibilityMode',
            null,
            InputOption::VALUE_OPTIONAL,
            'Czy jest w trybie zgodności',
            false
        );
        $this->getDefinition()->addOption($compatibilityModeOption);

        $this->registerCommands();

        return parent::doRun($input, $output);
    }

    private function registerCommands()
    {
        $cmdFactory = new CommandFactory();
        foreach ($cmdFactory->getCommandNames() as $cmdName) {
            $this->register($cmdName)
                ->setCode(function (InputInterface $input, OutputInterface $output) use ($cmdName, $cmdFactory) {
                    $compatibilityMode = $input->getOption('compatibilityMode');
                    $cmd = $cmdFactory->createFrom($cmdName, (bool)$compatibilityMode);
                    $cmd->setLogger(function (string $msg) use ($output) {
                        $output->writeln("<info>Output:</info> {$msg}");
                    });
                    $cmd->run();
                });
        }
    }
}
