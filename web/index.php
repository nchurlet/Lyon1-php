<?php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';
require __DIR__ . '/../src/app.php';
require __DIR__ . '/../config/dev.php';


$app->get('/', function () use ($app) {
  return $app['twig']->render('hello.twig', array(
       'name' => "perruche",
   ));
});

$app->run();
