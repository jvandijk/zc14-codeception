<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class ApiHelper extends \Codeception\Module
{
    protected $acceptHeader;

    public function _beforeSuite($config)
    {
        if (array_key_exists('config', $config)) {
            $this->acceptHeader = $config['config']['data']['accept'];
        }
    }

    public function getAcceptHeader()
    {
        return $this->acceptHeader;
    }
}
