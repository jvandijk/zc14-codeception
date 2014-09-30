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

    public function testIfPortReachable(MigrateTester $I)
    {
        $I->seeIfPortIsReachable('www.zendcon.com', 80);
    }

    public function testIfDnsCanBeResolved(MigrateTester $I)
    {
        $I->seeAddressIsMatchingIp('zendcon.com', '50.56.0.87');
    }
}
