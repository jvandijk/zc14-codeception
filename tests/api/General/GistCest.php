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

    public function testGetGist(ApiTester $I)
    {
        $I->wantTo('see if the we can get a gist');
        $I->haveHttpHeader('Accept', 'application/vnd.github.beta+json');
        $I->sendGet('/gists/2c47c9d59f4a5214f0c3');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
