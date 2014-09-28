<?php

use Codeception\Lib\InnerBrowser;
use Codeception\Module\PhpBrowser;
use Symfony\Component\CssSelector\CssSelector;

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

    public function seeIfNameExistsViaOverridedFetch()
    {
        $I = $this;
        $html = $this->getHtml(HomePage::$URL, '');
        PHPUnit_Framework_Assert::assertContains('zendcon', $html, '', true);
    }

    /**
     * return the raw html from url
     * @param $page
     * @param $path
     */
    public function getHtml($page, $path)
    {
        $I = $this;
        // use the internal testsuite phpbrowser for normal retrieval
        $I->amOnPage($page);
        return $this->getHtmlFromContent($I->fetchModule('PhpBrowser'), $path);
    }

    /**
     * returns the html found per locator (css, xpath, regex)
     * @param Session $session
     * @param $cssOrXPathOrRegex
     * @return null|string
     * @throws ElementNotFound
     */
    public function getHtmlFromContent(InnerBrowser $innerBrowser, $cssOrXPathOrRegex)
    {
        $crawler = $this->getCrawler($innerBrowser);
        $selector = CssSelector::toXPath($cssOrXPathOrRegex);
        $value = $crawler->filterXPath($selector);
        return $value->html();
    }

    protected function getCrawler(InnerBrowser $innerBrowser)
    {
        $reflection = new \ReflectionClass(get_class($innerBrowser));
        $property = $reflection->getProperty('crawler');
        $property->setAccessible(true);
        return $property->getValue($innerBrowser);
    }
}
