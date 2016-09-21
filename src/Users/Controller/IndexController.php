<?php

namespace App\Users\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function indexAction(Request $request, Application $app)
    {
        return $app['twig']->render('hello.html.twig', array('name' => 'perruche'));
    }
}
