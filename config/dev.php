<?php
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

// Enable PHP Error level
error_reporting(E_ALL);
ini_set('display_errors','On');

// Enable debug mode
$app['debug'] = true;
