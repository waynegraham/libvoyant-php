<?php
/* set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
class Voyeur_HttpTransport_Response
{
    static private $_defaultStatusMessage = array(
        0 => 'Communication Error',
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        302 => 'See Other',
        304 => "Not Modified",
        305 => "Use Proxy",
        307 => "Temporary Redirect",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Request Range Not Satisfiable",
        417 => "Expectation Failed",
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported"
    );

    private $_statusCode, $_statusMessage;
    private $_mimeType, $_encoding, $_responseBody;

    public static function getDefaultStatusMessage($statusCode)
    {
        $statusCode = (int) $statusCode;

        if (isset(self::$_defaultStatusMessage[$statusCode])) {
            return self::$_defaultStatusMessage[$statusCode];
        }

        return "Unknown Status";
    }

    public function __construct($statusCode, $contentType, $responseBody)
    {
        $this->_statusCode = (int) $statusCode;

        $this->_statusMessage = self::getDefaultStatusMessage($this->_statusCode);

        $this->_responseBody = (string) $responseBody;

        $this->_mimeType = 'text/plain';
        $this->_encoding = 'UTF-8';

    }

    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    public function getStatusMessage()
    {
        return $this->_statusMessage;
    }

    public function getMimeType()
    {
        return $this->_mimeType;
    }

    public function getEncoding()
    {
        return $this->_encoding;
    }

    public function getBody()
    {
        return $this->_responseBody;
    }



}
