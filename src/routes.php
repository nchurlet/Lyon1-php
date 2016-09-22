<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('usersList');
