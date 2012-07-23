<?php
/* :set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once dirname(__FILE__) . '/Response.php';

interface Voyeur_HttpTransport_Interface
{
    /**
     * Get the current default timeout for all HTTP requests
     *
     * @return float
     */
    public function getDefaultTimeout();

    /**
     * Set the current default timeout for all HTTP requests
     *
     * @param float $timeout Timeout
     *
     * @return void
     */
    public function setDefaultTimeout($timeout);

    /**
     * Set the authentication credentials to pass with the request
     *
     * @param string $username Username
     * @param string $password Password
     *
     * @return void
     */
    public function setAuthenticationCredentials($username, $password);

    /**
     * Perfom a GET HTTP operation with an optional timeout and return the 
     * response contents, use getLastResponseHeaders to retrieve HTTP headers
     *
     * @param string $url     URL
     * @param float  $timeout Timeout
     *
     * @return Voyeur_HttpTransport_Response
     */
    public function performGetRequest($url, $timeout = false);

    /**
     * Perform a HEAD HTTP operation with an optional timeout and return the
     * response headers.
     *
     * @param string $url     URL to fetch
     * @param float  $timeout Timeout
     *
     * @return Voyeur_HttpTransport_Response HTTP response
     */
    public function performHeadRequest($url, $timeout = false);

    /**
     * Perform a POST HTTP operation with an optional timeout and reutrn
     * the response contents, use getLastResponseHeaders to retrieve HTTP
     * headers
     *
     * @param string $url         URL to test
     * @param string $rawPost     Post content
     * @param string $contentType Content mime type
     * @param float  $timeout     Timeout to wait
     *
     * @return Voyeur_HttpTransport_Response HTTP response
     */
    public function performPostRequest($url, $rawPost, $contentType, $timeout = false);
}
