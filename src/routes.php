<?php

$app->get('/hello', 'Users\Controller\IndexController::indexAction')->bind('hello');
