<?php

$directoryIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/src/'));
$filesIterator = new CallbackFilterIterator($directoryIterator, function (SplFileInfo $fileInfo) {
    return $fileInfo->isFile() && pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'php';
});
/** @var SplFileInfo $fileInfo */
foreach ($filesIterator as $fileInfo) {
    info("Processing: {$fileInfo->getBasename()}");
    if (preg_match('/^(<\?php\s*)\n/s', file_get_contents($fileInfo->getPathname()), $match)) {
        $fp = fopen($fileInfo->getPathname(), 'r');

        if (file_exists($fileInfo->getPathname() . '.new')) {
            unlink($fileInfo->getPathname() . '.new');
        }
        $nfp = fopen($fileInfo->getPathname() . '.new', 'w+');

        fseek($fp, strlen($match[1]));

        warn('Writing temp file...');
        fwrite($nfp, "<?php declare(strict_types=1);");
        fwrite($nfp, fread($fp, $fileInfo->getSize() - ftell($fp)));

        fclose($fp);
        fclose($nfp);

        warn('Replacing original file...');
        unlink($fileInfo->getPathname());
        rename($fileInfo->getPathname() . '.new', $fileInfo->getPathname());
    }
}
function info(string $msg)
{
    writeln($msg, 32);
}
function warn(string $msg)
{
    writeln($msg, 33);
}
function error(string $msg)
{
    writeln($msg, 31);
}
function writeln(string $msg, int $code)
{
    printf("\033[0;%dm%s\033[0m\n", $code, $msg);
}