<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once dirname(__FILE__) . '/Interface.php';

abstract class Voyeur_HttpTransport_Abstract implements Voyeur_HttpTransport_Interface
{
    private $_defaultTimeout = false;

    /**
     * Get the current default timeout setting (initially the 
     * <code>default_socket_timeout</code> ini setting) in seconds
     *
     * @return float
     */
    public function getDefaultTimeout()
    {
        if ($this->_defaultTimeout === false) {
            $this->_defaultTimeout = (int) ini_get('default_socket_timeout');

            // double check timeout != 0
            if ($this->_defaultTimeout <= 0) {
                $this->_defaultTimeout = 60;
            }
        }

        return $this->_defaultTimeout;
    }

    /**
     * Set the current default timeout for all HTTP requests
     *
     * @param float $timeout Time to wait
     *
     * @return void
     */
    public function setDefaultTimeout($timeout)
    {
        $timeout = (float) $timeout;

        if ($timeout >= 0) {
            $this->_defaultTimeout = $timeout;
        }
    }
}
