<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerName
 *
 * @author Cawa
 */


namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ControllerName extends AbstractHelper
{

protected $routeMatch;

    public function __construct($routeMatch)
    {
        $this->routeMatch = $routeMatch;
    }

    public function __invoke()
    {
        $controller = $this->routeMatch->getParam('controller', 'index');
        return $controller;
    }
}