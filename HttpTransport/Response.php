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

    /**
     * Get an HTTP status message based on a status code
     *
     * @param integer $statusCode Status code to look up
     *
     * @return string Status code message
     */
    public static function getDefaultStatusMessage($statusCode)
    {
        $statusCode = (int) $statusCode;

        $message = "Unknown Status";

        if (isset(self::$_defaultStatusMessage[$statusCode])) {
            $message = self::$_defaultStatusMessage[$statusCode];
        }

        return $message;
    }

    /**
     * Construct an HTTP transport response
     *
     * @param integer $statusCode   HTTP status code
     * @param string  $contentType  Value of the Content-Type HTTP header
     * @param string  $responseBody Body of the HTTP response
     */
    public function __construct($statusCode, $contentType, $responseBody)
    {
        $this->_statusCode = (int) $statusCode;

        $this->_statusMessage = self::getDefaultStatusMessage($this->_statusCode);

        $this->_responseBody = (string) $responseBody;

        $this->_mimeType = 'text/plain';
        $this->_encoding = 'UTF-8';

        if ($contentType) {
            $contentTypeParts = explode(';', $contentType, 2);

            if (isset($contentTypeParts[0])) {
                $this->_mimeType = trim($contentTypeParts[0]);
            }

            if (isset($contentTypeParts[1])) {
                $contentTypeParts = explode('=', $contentTypeParts[1]);

                if (isset($contentTypeParts[1])) {
                    $this->_encoding = trim($contentTypeParts[1]);
                }
            }
        }

    }

    /**
     * Return the response's status code
     *
     * @return integer Status code
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * Return the response's status message
     *
     * @return string Status message
     */
    public function getStatusMessage()
    {
        return $this->_statusMessage;
    }

    /**
     * Return the mimetype of the response body
     *
     * @return string Response body mimetype
     */
    public function getMimeType()
    {
        return $this->_mimeType;
    }

    /**
     * Return the charset encoding for the response body
     *
     * @return string Response body's charset encoding
     */
    public function getEncoding()
    {
        return $this->_encoding;
    }

    /**
     * Get the raw response body
     *
     * @return string Response body
     */
    public function getBody()
    {
        return $this->_responseBody;
    }



}
