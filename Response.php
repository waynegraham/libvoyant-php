<?php

class Voyeur_Response
{
    protected $response, $isParsed, $parsedData;

    protected $createDocuments = true,
        $collapseSingleValueArrays = true;

    public function __construct(Voyeur_HttpTransport_Response $response)
    {
        $this->response = $response;
    }

    public function getHttpStatus()
    {
        return $this->response->getStatusCode();
    }

    public function getHttpStatusMessage()
    {
        return $this->response->getStatusMessage();
    }

    public function getType()
    {
        return $this->response->getMimeType();
    }

    public function getEncoding()
    {
        return $this->response->getEncoding();
    }

    public function getRawResponse()
    {
        return $this->response->getBody();
    }

    public function __get($key)
    {

    }

}
