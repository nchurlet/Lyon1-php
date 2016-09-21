<?php

$app->get('/hello', 'App\Users\Controller\IndexController::indexAction')->bind('hello');
