<?php
/* set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once dirname(__FILE__) . '/Response.php';

interface Voyeur_HttpTransport_Interface
{
    public function getDefaultTimeout();

    public function setDefaultTimeout($timeout);

    public function setAuthenticationCredentials($username, $password);

    public function performGetRequest($url, $timeout = false);

    public function performHeadRequest($url, $timeout = false);

    public function performPostRequest($url, $rawPost, $contentType, $timeout = false);
}
