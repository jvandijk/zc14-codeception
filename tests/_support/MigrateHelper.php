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
}
