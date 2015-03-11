<?php
class Example02Test extends PHPUnit_Extensions_Selenium2TestCase
{
    public static function browsers()
    {
        return array(
            array(
                 'host' => '127.0.0.1',
                 'port' => 4444,
                 'browser' => 'firefox test browser',
                 'browserName' => 'firefox',
            ),
            array(
                 'host' => '127.0.0.1',
                 'port' => 4444,
                 'browser' => 'chrome test browser',
                 'browserName' => 'chrome',
            ),
            array(
                 'host' => '127.0.0.1',
                 'port' => 4445,
                 'browser' => 'ie test browser',
                 'browserName' => 'ie',
            ),
        );
    }

    public function setup()
    {
        $this->setBrowserUrl('http://google.com/');
    }

    public function setUpPage()
    {
        $this->url('/');
    }

    public function test_search_click()
    {
        $this->byName('q')->value('Selenium');
        $this->byCssSelector('input[value="Google 搜尋"]')->click();
        $this->waitAjaxComplete();
        $element = $this->byCssSelector('#rso .srg >li.g:first-child h3 a');
        $this->assertEquals('Selenium - Web Browser Automation', $element->text());
        $this->assertEquals('http://www.seleniumhq.org/', $element->attribute('href'));
    }

    public function test_search_enter()
    {
        $this->byName('q')->value('Selenium');
        $this->keys(PHPUnit_Extensions_Selenium2TestCase_Keys::ENTER);
        $this->waitAjaxComplete();
        $element = $this->byCssSelector('#rso .srg >li.g:first-child h3 a');
        $this->assertEquals('Selenium - Web Browser Automation', $element->text());
        $this->assertEquals('http://www.seleniumhq.org/', $element->attribute('href'));
    }

    public function waitAjaxComplete()
    {
        $this->waitUntil(function(){
            if($this->byCssSelector('#rso')->displayed()){
                return true;
            }
        }, 10000);
    }
}