# Example of decoupled Symfony Console Application

## Usage

Simply run:

```bash
bin/console
```

## Non coupled definition

Sample [Application](src/Application.php#L36)

```php
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
```
