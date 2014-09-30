<?php
namespace Codeception\Module;


// here you can define custom actions
// all public methods declared in helper class will be available in $I

class MigrateHelper extends \Codeception\Module
{
    public function seeIfLineExistsInFile($file, $line)
    {
        $filesystem = $this->getModule('Filesystem');
        $filesystem->seeFileFound($file);
        $filesystem->seeInThisFile($line);
    }

    public function seeIfPortIsReachable($host, $port)
    {
        $cli = $this->getModule('Cli');
        $cli->runShellCommand('nmap '.$host.' -Pn -p '.$port);
        $cli->seeInShellOutput($port.'/tcp open');
    }
}
