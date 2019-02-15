<?php

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

try {
    $routes = new RouteCollection();

    // Add Routing here
    $convert = new Route(
        '/api/v1/convert',
        array('api' => 'api/Currency','method'=>'convert')
    );
    
    $routes->add('convert', $convert);


    // Add Routing end

    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());

    $matcher = new UrlMatcher($routes, $context);

    $parameters = $matcher->match($context->getPathInfo());
    
    require_once __DIR__.'/'.$parameters['api'].'.php';

    call_user_func_array(array(ucfirst(str_replace("/","\\",$parameters['api'])), $parameters['method']), array());

}
catch (ResourceNotFoundException $e) {
  echo $e->getMessage();
}