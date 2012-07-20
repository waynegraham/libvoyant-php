<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VoyeurService 
 *
 * @category  Web_Services
 * @package   Voyeur
 * @author    Wayne Graham <wayne.graham@gmail.com>
 * @author    Eric Rochester <>
 * @copyright 2012 For realz
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 * @link      https://github.com/waynegraham/libvoyant-php
 */
class VoyeurService
{
    protected $host, $port, $path;

    /**
     * Constructor. All parameters are optional and will use default 
     * values if not specified
     *
     * @param string $host Hostname
     * @param string $port Port
     * @param string $path Path
     *
     * @return void
     */
    public function __construct($host = 'voyeurtools.org', $port = '80', $path = '/trombone')
    {
        $this->setHost($host);

        return $this;

    }

    /**
     * Set the host to be used. If empty, throws an exception
     *
     * @param string $host Host to use
     *
     * @throws InvalidArgumentException If the host parametet is empty
     *
     * @return void
     */
    public function setHost($host)
    {
        if (empty($host)) {
            throw new InvalidArgumentException('Host parameter cannot be empty');
        }

        $this->host = $host;
    }  

    /**
     * Return the host
     *
     * @return string 
     */
    public function getHost()
    {
        return $this->host;
    }
}
