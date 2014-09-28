<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class AcceptanceHelper extends \Codeception\Module
{
    public function fetchModule($moduleName)
    {
        return $this->getModule($moduleName);
    }

    public function seeEquals($actual, $expected, $message = '')
    {
        $this->assertEquals($actual, $expected, $message);
    }
}
