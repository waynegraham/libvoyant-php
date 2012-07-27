<?php

require_once dirname(__FILE__) . '/Abstract.php';

class Voyeur_HttpTransport_Curl extends Voyeur_HttpTransport_Abstract
{
    private $_curl;

    /**
     * Initialize a curl session
     */
    public function __construct()
    {
        $this->_curl = curl_init();

        curl_setopt_array(
            $this->_curl,
            array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_BINARYTRANSFER => true,
                CURLOPT_HEADER => false
            )
        );
    }

    /**
     * Close the curl session
     *
     * @return void
     */
    public function __destruct()
    {
        curl_close($this->_curl);
    }

    /**
     * Set the authentication credentials
     *
     * @param string $username Username
     * @param string $password Password
     *
     * @return void
     */
    public function setAuthenticationCredentials($username, $password)
    {
        curl_setopt_array(
            $this->_curl,
            array(
                CURLOPT_USERPWD => $username . ':' . $password,
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC
            )
        );
    }

    /**
     * Perform a GET rquest
     *
     * @param string  $url     URL target
     * @param integer $timeout Timeout
     *
     * @return Voyeur_HttpTransport_Reponse
     */
    public function performGetRequest($url, $timeout = false)
    {
        $timeout = parseTimeout($timeout);

        curl_setopt_array(
            $this->_curl,
            array(
                CURLOPT_NOBODY => false,
                CURLOPT_HTTPGET => true,
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => $timeout
            )
        );

        return self::prepareResponse();
    }

    /**
     * Get the HEAD response
     *
     * @param string  $url     URL target
     * @param integer $timeout Timeout
     *
     * @return Voyeur_HttpTransport_Reponse
     */
    public function performHeadRequest($url, $timeout = false)
    {
        $timeout = parseTimeout($timeout);

        curl_setopt_array(
            $this->_curl,
            array(
                CURLOPT_NOBODY => true,
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => $timemout
            )
        );

        return self::prepareResponse();
    }

    /**
     * Perform a POST
     *
     * @param string $url         URL target
     * @param string $postData    Data to post
     * @param string $contentType Content mimetype
     * @param string $timeout     Timeout
     *
     * @return Voyeur_HttpTransport_Reponse
     */
    public function performPostRequest($url, $postData, $contentType, $timeout = false)
    {
        $timeout = parseTimeout($timeout);

        curl_setopt_array(
            $this->_curl,
            array(
                CURLOPT_NOBODY => true,
                CURLOPT_POST => true,
                CURLOPT_URL => $url,
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array("Content-Type: {$contentType}"),
                CURLOPT_TIMEOUT => $timeout
            )
        );


        return self::prepareResponse();
    }

    /**
     * Prepare the Voyeur_HttpTransport response object
     *
     * @return Voyeur_HttpTransport_Reponse
     */
    protected function prepareResponse()
    {
        $responseBody = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($this->_curl, CURLINFO_CONTENT_TYPE);

        $response = new Voyeur_HttpTransport_Reponse(
            $statusCode,
            $contentType,
            $responseBody
        );

        return $response;
    }

    /**
     * Parse the timeout variable passed and ensure it is withint expected
     * parameters.
     *
     * @param integer $timeout Timeout to parse
     *
     * @return numeric timeout
     */
    protected function parseTimeout($timeout)
    {
        if ($timeout === false || $timeout <= 0.0) {
            $timeout = $this->getDefaultTimeout();
        }

        return $timeout;
    }
}
