<?php

namespace SiberianWolf\Router;

use SiberianWolf\Router\Exception\InvalidRouteNameException;
use SiberianWolf\Router\Exception\InvalidRouteMethodException;
use SiberianWolf\Router\Exception\InvalidRouteActionException;
use SiberianWolf\Router\Exception\InvalidRouteControllerException;
use SiberianWolf\Router\Exception\InvalidRouteUriPatternException;

/**
 * Validate route
 * Class Route.
 */
class Route implements RouteInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $uriPattern;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $allowedMethods = ['get', 'post', 'put', 'delete', 'any'];

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $params = array();

    public function __construct($name, $uriPattern, $method, $controller, $action, array $params = [])
    {
        $this->setName($name);
        $this->setUriPattern($uriPattern);
        $this->setMethod($method);
        $this->setController($controller);
        $this->setAction($action);
        $this->setParams($params);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @throws InvalidRouteNameException
     */
    public function setName($name)
    {
        $name = trim($name);
        if (strlen($name) <= 0) {
            throw new InvalidRouteNameException("Invalid route name: $name");
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUriPattern()
    {
        return $this->uriPattern;
    }

    /**
     * @param string $uriPattern
     *
     * @throws InvalidRouteUriPatternException
     */
    public function setUriPattern($uriPattern)
    {
        $uriPattern = trim($uriPattern);
        if (strlen($uriPattern) <= 0) {
            throw new InvalidRouteUriPatternException("Invalid route UriPattern: $uriPattern");
        }

        $this->uriPattern = $uriPattern;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     *
     * @throws InvalidRouteMethodException
     */
    public function setMethod($method)
    {
        if (!in_array($method, $this->allowedMethods)) {
            throw new InvalidRouteMethodException("Invalid route method: $method");
        }

        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param $controller
     *
     * @throws InvalidRouteControllerException
     */
    public function setController($controller)
    {
        if (strlen($controller) <= 0) {
            throw new InvalidRouteControllerException("Invalid route controller: $controller");
        }

        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     *
     * @throws InvalidRouteActionException
     */
    public function setAction($action)
    {
        if (strlen($action) <= 0) {
            throw new InvalidRouteActionException("Invalid route action: $action");
        }

        $this->action = $action;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getParam($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }

        return;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        foreach ($params as $name => $value) {
            $this->addParam($name, $value);
        }
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function removeParam($name)
    {
        if (isset($this->params[$name])) {
            unset($this->params[$name]);
        }
    }
}
