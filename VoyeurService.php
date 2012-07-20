<?php

class VoyeurService
{
  protected $_host, $_port, $_path;
  
  public function __construct($host = 'localhost', $port = '8080', $path = '/')
    {
        $this->setHost($host);

    }

  public function setHost($host)
  {
    if (empty($host)) {
      throw new Voyeur_Service_InvalidArgumentException('Host parameter cannot be empty');
    }

    $this->_host = $host;
  }  

  public function getHost()
  {
    return $this->_host;
  }
}
