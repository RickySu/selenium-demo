<?php
class Example2Test extends PHPUnit_Extensions_Selenium2TestCase
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
        
        $this->execute(array(
            'script' => "\$('button[data-whatever=\"@mdo\"]').click();",
            'args' => array(),  
        ));
        
        $this->waitUntil(function(){
            if($this->byCssSelector('#exampleModal button[data-dismiss="modal"]')->displayed()){
                return true;
            }
        }, 10000);
        
        $label = $this->execute(array(
            'script' => "return \$('#exampleModalLabel').html();",
            'args' => array(),  
        ));        
        
        $this->assertEquals('New message to @mdo', $label);

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
    
    public function test_callback()
    {
        $this->url('/');
        $this->timeouts()->asyncScript(10000);
        $html = $this->executeAsync(array(
            'script' => '
                var callback = arguments[0];
                $.get("/javascript/", function(data){
                    return callback(data);                
                })
            ',
            'args' => array(),  
        ));
        $this->assertGreaterThan(0, preg_match('/^<!DOCTYPE html>/i', $html));
    }    
}