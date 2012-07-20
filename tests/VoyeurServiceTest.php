<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
class Voyeur_ServiceTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorDefaultArguments()
    {
        $fixture = new VoyeurService();
        $this->assertInstanceOf('VoyeurService', $fixture);
    }

    public function testGetHostWithDefaultConstructor()
    {
        $fixture = new VoyeurService();
        $host = $fixture->getHost();

        $this->assertEquals('voyeurtools.org', $host);
    }

    public function testSetHost()
    {
        $host = "localhost";
        $fixture = new VoyeurService();

        $fixture->setHost($host);

        $this->assertEquals($host, $fixture->getHost());

    }

    public function testSetEmptyHost()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'Host parameter cannot be empty'
        );

        $fixture = new VoyeurService();
        $fixture->setHost('');
    }

    public function testSetHostWithConstructor()
    {
        $host = 'example.com';

        $fixture = new VoyeurService($host);


        $this->assertEquals($host, $fixture->getHost());
    }
}
