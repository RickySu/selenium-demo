<?php
class Example4Test extends PHPUnit_Extensions_Selenium2TestCase
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
        
    public function test_max()
    {
        $this->currentWindow()->maximize();
        $this->url('/');
        sleep(1);
        $this->assertTrue($this->byCssSelector("#homeBanner")->displayed());
    }
  
    public function test_monile()
    {
        $this->currentWindow()->size(array('width' => 400, 'height' => 600));    
        $this->url('/');    
        sleep(1);
        $this->assertFalse($this->byCssSelector("#homeBanner")->displayed());        
    }    

}