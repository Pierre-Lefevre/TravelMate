<?php

namespace TM\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TripController extends Controller
{
    public function indexAction()
    {
        return $this->render('TMPlatformBundle:Trip:index.html.twig');
    }
}
