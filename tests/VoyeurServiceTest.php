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

    public function testSetPortWithConstructor()
    {
        $port = 1234;

        $fixture = new VoyeurService('localhost', $port);

        $this->assertEquals($port, $fixture->getPort());
    }

    public function testSetPath()
    {
        $path = 'test';
        $this->fixture->setPath($path);

        $this->assertEquals($path, $this->fixture->getPath());
    }

    public function testGetPathWithDefaultParameters()
    {
        $this->assertEquals('/trombone', $this->fixture->getPath());
    }

    public function testSetPathWithConstructor()
    {
        $path = '/violin';

        $fixture = new VoyeurService('localhost', '1234', $path);

        $this->assertEquals($path, $fixture->getPath());
    }

    public function testSetPathWithInvalidParameter()
    {
         $this->setExpectedException(
            'InvalidArgumentException',
            'The path cannot be empty.'
        );

        $fixture = new VoyeurService('localhost', '8080', '');
    }

    public function testConstructUrl($params = array())
    {

    }
}
