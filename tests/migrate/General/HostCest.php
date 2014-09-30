<?php
namespace General;
use \MigrateTester;

class HostCest
{
    // tests
    public function testIfHostsFileIsConfigured(MigrateTester $I)
    {
        $I->seeIfLineExistsInFile('/etc/hosts', '127.0.0.1');
    }
}
