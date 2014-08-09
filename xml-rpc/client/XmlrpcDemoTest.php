<?php
require_once('XmlrpcDemo.php');
class XmlrpcDemoTest extends PHPUnit_Framework_TestCase
{


    public function testRun()
    {
        $client = new XmlrpcDemo();
        $this->assertSame(3,$client->run(1,2));

    }

}
?>