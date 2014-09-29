<?php
namespace General;
use \ApiTester;

class GistCest
{
    // tests
    public function testGetGists(ApiTester $I)
    {
        $I->wantTo('see if the we can get the gists listing');
        $I->haveHttpHeader('Accept', 'application/vnd.github.beta+json');
        $I->sendGet('/users/weierophinney/gists');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
