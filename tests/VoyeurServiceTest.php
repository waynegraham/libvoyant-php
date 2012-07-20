<?php

class Voyeur_ServiceTest extends PHPUnit_Framework_TestCase
{
    public function testSetHost()
    {
      $host = "localhost";
      $fixture = new VoyeurService();

      $fixture->setHost($host);

      $this->assertEquals($host, $fixture->getHost());

    }
}
