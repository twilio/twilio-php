<?php
use \Mockery as m;

require_once 'Twilio/AutoPagingIterator.php';

class AutoPagingIteratoTest extends PHPUnit_Framework_TestCase {

     function tearDown() {
         m::close();
     }
     
     /**
      * @expectedException BadMethodCallException
      */
     function testNoCount() {
         $resource = m::mock('Services_Twilio_ListResource');
         $iterator = new Services_Twilio_AutoPagingIterator($resource);
         $iterator->count();
     }
     
     function testNotValid() {
         $resource = m::mock('Services_Twilio_ListResource');
         $resource->shouldReceive('getList')->once()
              ->andReturn(array());
              
         $iterator = new Services_Twilio_AutoPagingIterator($resource);
        $this->assertFalse($iterator->valid());
     }
     
     function testValid() {
         $resource = m::mock('Services_Twilio_ListResource');
         $resource->shouldReceive('getList')->once()
              ->andReturn(array("foo"));
              
         $iterator = new Services_Twilio_AutoPagingIterator($resource);
        $this->assertTrue($iterator->valid());
     }
}