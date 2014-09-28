<?php
namespace General;

/**
 * Class MenuCest
 *
 * @package General
 * @guy CompareSteps
 */
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

    public function seeIfNameExistsViaCCStep(\CompareSteps $I)
    {
        $I->seeIfNameExists();
    }

    public function seeIfNameExistsViaCCStepAndPageObject(\CompareSteps $I)
    {
        $I->seeIfNameExistsViaPageObject();
    }

    public function seeIfNameExistsWithOverridedFetch(\CompareSteps $I)
    {
        $I->seeIfNameExistsViaOverridedFetch();
    }
}
