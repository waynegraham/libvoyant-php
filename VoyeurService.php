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

    // query delimters
    protected $queryDelimeter = '?', $queryStringDelimiter = '&', $queryBrackesEscaped = true;

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
        $this->setPort($port);
        $this->setPath($path);

        return $this;
    }

    /**
     * Set Path to be used. If empty, thow an exception
     *
     * @param string $path Path to set
     *
     * @throws InvalidArgumentException 
     *
     * @return void
     */
    public function setPath($path)
    {
        if (empty($path)) {
            throw new InvalidArgumentException('The path cannot be empty.');
        }

        $this->path = $path;
    }

    /**
     * Return the path
     *
     * @return string Path string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the port to be used. If empty, thow an exception
     *
     * @param integer $port Port number
     *
     * @throws InvalidArgumentException If the port number is empty
     *
     * @return void
     */
    public function setPort($port)
    {
        $port = (int) $port;

        if ($port <= 0) {
            throw new InvalidArgumentException('Port must be a valid number');
        }

        $this->port = $port;
    }

    /**
     * Return the port
     *
     * @return integer Port number
     */
    public function getPort()
    {
        return $this->port;
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

    protected function constructUrl($params = array())
    {
        $queryString = '';

        if (count($params)) {
            $escapedParams = array();

            foreach ($params as $key => $value) {
                $escapedParams[] = urlencode($key) . '=' . urlencode($value);
            }

            $queryString = $this->queryDelimiter . implode(
                $this->queryStringDelimiter,
                $escapedParams
            );
        }

        $slug = 'http://' . $this->host . ':' . $this->port . $this->path
            . $queryString;

        return $slug;
    }

    protected function generateQueryString($params)
    {
        $queryString = http_build_query($params);

        return preg_replace('/\\[(?:[0-9]|[1-9][0-9]+)\\]=/', '=', $queryString);
    }

    protected function sendRawGet($url, $timeout = FALSE)
    {

    }

    protected function sendRawPost($url, $rawPost, $timeout = FALSE, $contentType = 'text/xml; charset=UTF-8')
    {

    }

}
