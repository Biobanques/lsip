<?php

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
    ),
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'CBSD - Serveur d\'Identité Patient',
    'defaultController' => 'site/login',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.wsModels.*',
        'application.components.*',
        'ext.*',
        'ext.bootstrap.*',
        'ext.bootstrap.components.*',
        'ext.bootstrap.widgets.*',
        'ext.bootstrap.helpers.TbHtml',
        'ext.bootstrap.helpers.TbArray',
        'ext.bootstrap.behaviors.*',
    ),
    'modules' => array(
// uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array('bootstrap.gii'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
// enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser'
        ),
        'cache' => array(
            'class' => 'system.caching.CApcCache'
        ),
        'db' => array(
            'connectionString' => CommonProperties::$CONNECTION_STRING,
            'emulatePrepare' => true,
            'username' => CommonProperties::$CONNECTION_USERNAME,
            'password' => CommonProperties::$CONNECTION_PASSWORD,
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
// this is used in contact page
        'adminEmail' => CommonProperties::$ADMIN_EMAIL,
    ),
);
