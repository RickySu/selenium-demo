<?php
class Example00Test extends PHPUnit_Extensions_Selenium2TestCase
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
        );
    }

    public function setup()
    {
        $this->setBrowserUrl('http://play.niceday.tw/');
    }

    public function setUpPage()
    {
        $this->url('/');
    }

    public function test_hover()
    {
        sleep(2);
        $element = $this->byCssSelector('header.visible-lg ul.nav >li:first-child');
        $this->moveto($element);
        sleep(2);
    }

}