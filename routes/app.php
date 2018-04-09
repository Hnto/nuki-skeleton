<?php

/** @var \Nuki\Handlers\Http\Input\Request $requestHandler */
$requestHandler = $app->getService('request-handler');
$router = new \Nuki\Handlers\Http\Router($requestHandler);

/**
 * Here you can define you routes
 * The first param contains the URL
 * The second param can contain a callback function
 * or an array of the unit, service and process (no keys needed)
 */

$router->get('/', function () use ($app) {
    (new \Nuki\Handlers\Http\Output\Response(new \Nuki\Handlers\Http\Output\Renderers\RawRenderer()))
        ->setContent(new \Nuki\Models\IO\Output\Content('Hello world'))
        ->httpContentType('text/html')
        ->send();
});

/**
 * Examples
 *
 * First route takes a route param and passes
 * it in the function args. The $bar param is passed in the use statement.
 * Every parameter you define in the route is accessible in the function call
 * as the same name. {id} becomes $id, {name} becomes $name
 *
 * Second route takes a route (with optional params) and an array
 * of the unit, service and process that correspond to an available
 * unit (Authentication) an available service (Login) and a method in this service (form)
 *
 * The application will take care of the requirements for the service
 */
//$bar = 'bar';
//$router->get('/login/{id}', function ($id) use ($bar) {
//    echo $id . $bar;
//});

//$router->get('/login', ['Authentication', 'Login', 'form']);
