<?php

/**
 * Load env file
 */
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../settings/Application/', 'app.env');
$dotenv->load();

/**
 * Grab application environment property
 * and use it to set certain specifications
 */
//Set display error to false if environment is anything else than development
//This way no unnecessary application errors are shown to the user - only logged
if (\Nuki\Handlers\Core\Assist::getAppEnv() !== 'DEVELOPMENT') {
  ini_set('display_errors', false);
}

/**
 * Instantiate and initialize custom throwable handler
 * to handle all throwable errors
 */
$throwableHandling = new Nuki\Handlers\Core\ThrowableHandling();
$throwableHandling->init();

/**
 * Create the application
 * Inject pimple container in the application
 * This container will have all the necessary services, settings and params
 */
$app = new \Nuki\Application\Application(new \Pimple\Container());

/**
 * Set the storage driver
 */
$app::getContainer()->offsetSet('storage-driver', Nuki\Handlers\Core\Assist::getAppStorageDriver());

/**
 * Register service provider
 * with default libraries
 */
$app::getContainer()->register(new Nuki\Providers\Core\Storage\Base());
$app::getContainer()->register(new Nuki\Providers\Core\Input\Base());
$app::getContainer()->register(new Nuki\Providers\Core\Output\Base());
$app::getContainer()->register(new Nuki\Providers\Core\Helpers\Base());
$app::getContainer()->register(new Nuki\Providers\Core\Framework\Base());

/**
 * Set helper parameters
 */
$app->getService('params-handler')->add('app-dir', dirname(getcwd()));

/**
 * Setup routes
 */
require_once __DIR__ . '/../routes/app.php';

/**
 * Register router and setup routes
 */
$app->registerService($router);

/**
 * Return the instantiated application object
 */
return $app;
