<?php
namespace Codeception\Module;

use GuzzleHttp\Client;
use Codeception\Configuration;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class AcceptanceHelper extends \Codeception\Module
{
    public function _before(\Codeception\TestCase $test)
    {
        $this->setProxyInGuzzle($this->getModule('PhpBrowser')->guzzle);
    }

    public function _after(\Codeception\TestCase $test)
    {
        $this->setProxyInGuzzle($this->getModule('PhpBrowser')->guzzle);
    }

    public function setProxyInGuzzle(Client $client)
    {
        $config = Configuration::config();
        if (array_key_exists('proxy', $config['settings'])) {
            $client->setDefaultOption('proxy', $config['settings']['proxy']);
        }
    }

    public function fetchModule($moduleName)
    {
        return $this->getModule($moduleName);
    }

    public function seeEquals($actual, $expected, $message = '')
    {
        $this->assertEquals($actual, $expected, $message);
    }
}
