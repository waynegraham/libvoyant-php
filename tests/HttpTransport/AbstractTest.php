<?php

abstract class Voyeur_HttpTransport_AbstractTest extends PHPUnit_Framework_TestCase
{
  const TIMEOUT = 2;

  const GET_URL = '';
  const GET_RESPONSE_MIME_TYPE = 'text/plain';
  const GET_RESPONSE_ENCODING = 'UTF-8';
  const GET_RESPONSE_MATCH = '';

  const POST_URL = '';
  const POST_DATA = '';
  const POST_REQUEST_CONTENT_TYPE = 'application/x-www-form-urlencoded; charset=UTF-8';

  protected $fixture;

  abstract public function getFixture();

  public function setUp()
  {
    $this->fixture = $this->getFixture();
  }


  public function testGetDefaultTimeoutWithDefaultConstructor()
  {
    $timeout = $this->fixture->getDefaultTimeout();

    $this->assertGreatThan(0, $timeout);
  }
}
