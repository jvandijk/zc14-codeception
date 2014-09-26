<?php
namespace General;

class MenuCest
{
    public function _before(\AcceptanceTester $I)
    {
    }

    public function _after(\AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(\AcceptanceTester $I)
    {
    }

    public function seeIfNameExists(\AcceptanceTester $I)
    {
        $I->wantTo('see if conference name exists');
        $I->amOnPage('/');
        $I->see('zendcon');
    }
}
