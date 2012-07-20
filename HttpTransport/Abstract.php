<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once dirname(__FILE__) . '/Interface.php';

abstract class Voyeur_HttpTransport_Abstract implements Voyeur_HttpTransport_Interface
{
    private $_defaultTimeout = false;
}
