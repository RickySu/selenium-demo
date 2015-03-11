<?php
class Example01Test extends PHPUnit_Extensions_Selenium2TestCase
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
        $this->setBrowserUrl('');
    }

    public function test_drag_drop()
    {
        $this->url('http://jqueryui.com/resources/demos/droppable/default.html');
        $element = $this->byCssSelector('#draggable');
        $this->moveto($element);
        $this->buttondown();
        sleep(2);
        $this->moveto($this->byCssSelector('#droppable'));
        $this->buttonup();
        sleep(2);
    }

}