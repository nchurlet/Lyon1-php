<?php
use Silex\Application;
use Silex\Route;
use Silex\Provider\TwigServiceProvider;

$app = new Application();

//Ajout du fournisseur TwigProvider et déclaration du twig path.
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));



return $app;
