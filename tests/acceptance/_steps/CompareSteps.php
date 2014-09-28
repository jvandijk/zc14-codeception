<?php

class CompareSteps extends \AcceptanceTester
{
    public function seeIfNameExists()
    {
        $I = $this;
        $I->amOnPage('/');
        $I->see('zendcon');
    }

    public function seeIfNameExistsViaPageObject()
    {
        HomePage::of($this)->see('zendcon');
    }
}
