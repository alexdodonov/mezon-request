<?php
namespace Mezon\Transport;

use Mezon\Router\Router;

/**
 * Class Request
 *
 * @package Transport
 * @subpackage HttpRequestParams
 * @author Dodonov A.A.
 * @version v.1.0 (2020/05/26)
 * @copyright Copyright (c) 2020, aeon.org
 */

/**
 * GLobal request data
 */
class Request
{

    // TODO unbind with router
    /**
     * Global router
     *
     * @var Router
     */
    private static $globalRouter = null;

    /**
     * Method registers router
     *
     * @param Router $router
     *            router
     */
    public static function registerRouter(Router &$router): void
    {
        self::$globalRouter = $router;
    }

    /**
     * Method hashes checkbox state
     *
     * @param string $fieldName
     *            field name
     * @param array $vars
     *            check box values
     * @return mixed hash item
     */
    public static function getChecked(string $fieldName, array $vars)
    {
        if (self::getParam($fieldName, false) !== false) {
            // something was submitted
            return $vars[0];
        }

        return $vars[1];
    }

    /**
     * Fetching auth token from headers
     *
     * @param array $headers
     *            Request headers
     * @return string Session id
     */
    protected static function getSessionIdFromHeaders(array $headers)
    {
        $basicPrefix = 'Basic ';

        if (isset($headers['Authentication'])) {
            return str_replace($basicPrefix, '', $headers['Authentication']);
        } elseif (isset($headers['Authorization'])) {
            return str_replace($basicPrefix, '', $headers['Authorization']);
        } elseif (isset($headers['Cgi-Authorization'])) {
            return str_replace($basicPrefix, '', $headers['Cgi-Authorization']);
        }

        throw (new \Exception('Invalid session token', 2));
    }

    /**
     * Method returns list of the request's headers
     *
     * @return array Array of headers
     */
    protected static function getHttpRequestHeaders(): array
    {
        $headers = [];

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        }

        return $headers === false ? [] : $headers;
    }

    /**
     * Method returns session id from HTTP header
     *
     * @return string Session id
     */
    protected static function getSessionId()
    {
        $headers = self::getHttpRequestHeaders();

        return self::getSessionIdFromHeaders($headers);
    }

    /**
     * Method returns request parameter
     *
     * @param string $param
     *            parameter name
     * @param mixed $default
     *            default value
     * @return mixed Parameter value
     * @codeCoverageIgnore
     */
    public static function getParam($param, $default = false)
    {
        $headers = self::getHttpRequestHeaders();

        $return = $default;

        if ($param == 'session_id') {
            $return = self::getSessionId();
        } elseif (self::$globalRouter !== null && self::getRouter()->hasParam($param)) {
            $return = self::$globalRouter()->getParam($param);
        } elseif (isset($headers[$param])) {
            $return = $headers[$param];
        } elseif (isset($_POST[$param])) {
            $return = $_POST[$param];
        } elseif (isset($_GET[$param])) {
            $return = $_GET[$param];
        }

        return $return;
    }
}
