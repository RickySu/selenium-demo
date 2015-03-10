<?php
class clickTest extends \PHPUnit_Extensions_Selenium2TestCase
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
        $this->setBrowserUrl('http://getbootstrap.com/');
    }
    
    public function test_click()
    {
        $this->url('/javascript/');
        $element = $this->byCssSelector('button[data-target="#exampleModal"]');
        $this->moveto($element);
        $element->click();
        
        $this->waitUntil(function(){
            if($this->byCssSelector('#exampleModal button[data-dismiss="modal"]')->displayed()){
                return true;
            }
        }, 10000);
        
        $this->assertEquals('New message to @mdo', $this->byCssSelector('#exampleModalLabel')->text());

        $element = $this->byCssSelector('#exampleModal button[data-dismiss="modal"]');
        $this->moveto($element);
        $element->click();
        $time = time();
        $this->waitUntil(function() use($time){
            if(time()-$time > 1){
                return true;
            }
        }, 10000);
    }
}