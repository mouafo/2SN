<?php

namespace DB\Bundle\dbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DBdbBundle:Default:index.html.twig', array('name' => $name));
    }
}
