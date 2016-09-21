<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

$app = new Application();

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
