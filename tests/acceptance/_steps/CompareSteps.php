<?php

use Codeception\Lib\InnerBrowser;
use Codeception\Module\PhpBrowser;
use Codeception\Configuration;
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

    public function seeSameOnVersions($page, $path, $alternatePath, $message)
    {
        $I = $this;
        list($left, $right) = $this->getContentFromVersions($page, $path, $alternatePath);
        $I->seeEquals($left, $right, $message);
    }

    public function getContentFromVersions($page, $path, $alternatePath)
    {
        return array(
            $this->getHtml($page, $path),
            $this->getAlternateHtml($page, $alternatePath)
        );
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
     * return the raw html from master
     * @param $page
     * @param $path
     */
    public function getAlternateHtml($page, $path)
    {
        return $this->getHtmlFromContent($this->getPhpBrowserByPage($page), $path);
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

    /**
     * initiate a PhpBrowser instance with caching per page
     * @param $page
     * @return Codeception\Module\PhpBrowser
     */
    protected function getPhpBrowserByPage($page)
    {
        $phpBrowser = $this->getAlternatePhpBrowser();
        $phpBrowser->amOnPage($page);
        return $phpBrowser;

    }

    protected function getAlternatePhpBrowser()
    {
        $config = Configuration::config();
        $suite = Configuration::suiteSettings('acceptance', $config);
        $options = $suite['modules']['config']['PhpBrowser'];
        $options['url'] = $options['alternate-url'];
        $phpBrowser = new PhpBrowser($options);
        $phpBrowser->_initialize();
        return $phpBrowser;
    }

    protected function getCrawler(InnerBrowser $innerBrowser)
    {
        $reflection = new \ReflectionClass(get_class($innerBrowser));
        $property = $reflection->getProperty('crawler');
        $property->setAccessible(true);
        return $property->getValue($innerBrowser);
    }
}
