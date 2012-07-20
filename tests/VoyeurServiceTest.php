<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
class Voyeur_ServiceTest extends PHPUnit_Framework_TestCase
{

    var $fixture;

    public function setUp()
    {
        parent::setUp();
        $this->fixture = new VoyeurService();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
    
    public function testConstructorDefaultArguments()
    {
        $this->assertInstanceOf('VoyeurService', $this->fixture);
    }

    public function testGetHostWithDefaultConstructor()
    {
        $host = $this->fixture->getHost();

        $this->assertEquals('voyeurtools.org', $host);
    }

    public function testSetHost()
    {
        $host = "localhost";

        $this->fixture->setHost($host);

        $this->assertEquals($host, $this->fixture->getHost());

    }

    public function testSetEmptyHost()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'Host parameter cannot be empty'
        );

        $this->fixture->setHost('');
    }

    public function testSetHostWithConstructor()
    {
        $host = 'example.com';
        $this->fixture->setHost($host);

        $this->assertEquals($host, $this->fixture->getHost());
    }

    public function testSetPort()
    {
        $port = 1234;

        $this->fixture->setPort($port);

        $this->assertEquals($port, $this->fixture->getPort());
    }

    public function testGetPortWithDefaultParameters()
    {
        $this->assertEquals(80, $this->fixture->getPort());
    }

    public function testSetPortWithInvalidParameter()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'Port must be a valid number'
        );

        $this->fixture->setPort('broken');
    }

        
}
