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

    public function getMockHttpTransportInterface()
    {
        return $this->getMock(
            'Voyeur_HttpTransport_Interface',
            array(
                'getDefaultTimeout',
                'setDefaultTimeout',
                'setAuthenticationCredentials',
                'performGetRequest',
                'performHeadRequest',
                'performPostRequest'
            )
        );
    }

    public function testGetHttpTransportWithDefaultConstructor()
    {
        $httpTransport = $this->fixture->getHttpTransport();

        $this->assertInstanceOf(
            'Voyeur_HttpTransport_Interface',
            $httpTransport,
            'Default HTTP transport does not implement interface'
        );

        $this->assertInstanceOf(
            'Voyeur_HttpTransport_Curl',
            $httpTransport,
            'Default wrapper is Curl'
        );
    }

    public function testSetHttpTransport()
    {
        $transport = new Voyeur_HttpTransport_Curl();

        $this->fixture->setHttpTransport($transport);
        $httpTransport = $this->fixture->getHttpTransport();

        $this->assertInstanceOf('Voyeur_HttpTransport_Interface', $httpTransport);
        $this->assertInstanceOf('Voyeur_HttpTransport_Curl', $httpTransport);
        $this->assertEquals($transport, $httpTransport);
    }

    public function testSetHttpWithConstructor()
    {
        $transport = new Voyeur_HttpTransport_Curl();

        $fixture = new VoyeurService(
            'localhost',
            8080,
            '/trombone',
            $transport
        );


        $httpTransport = $fixture->getHttpTransport();

        $this->assertInstanceOf('Voyeur_HttpTransport_Interface', $httpTransport);
        $this->assertInstanceOf('Voyeur_HttpTransport_Curl', $httpTransport);

        $this->assertEquals($fixture->getHttpTransport(), $httpTransport);

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
        $path = '/test/';
        $this->fixture->setPath($path);

        $this->assertEquals($path, $this->fixture->getPath());
    }

    public function testSetPathWithSlashes()
    {
        $newPath = 'new/path';
        $containedPath = "/{$newPath}/";

        $this->fixture->setPath($newPath);
        $path = $this->fixture->getPath();

        $this->assertEquals($containedPath, $path, 'setPath did not ensure property with slashes');
    }

    public function testGetPathWithDefaultParameters()
    {
        $this->assertEquals('/trombone/', $this->fixture->getPath());
    }

    public function testSetPathWithConstructor()
    {
        $path = '/violin/';

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

    public function testGetDefaultTimeoutCallsThroughTransport()
    {
        $mockTransport = $this->getMockHttpTransportInterface();
        $mockTransport->expects($this->once())->method('getDefaultTimeout');

        $this->fixture->setHttpTransport($mockTransport);
        $timeout = $this->fixture->getDefaultTimeout();


    }

    public function testSetTimeoutThroughCallsToTransport()
    {
        $timeout = 12345;

        $mockTransport = $this->getMockHttpTransportInterface();
        $mockTransport->expects($this->once())->method('setDefaultTimeout')->with($this->equalTo($timeout));

        $this->fixture->setHttpTransport($mockTransport);
        $this->fixture->setDefaultTimeout($timeout);
    }

    public function testConstructUrl($params = array())
    {

    }
}
