<?php

namespace Quelp\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('QuelpMessageBundle:Default:index.html.twig', array('name' => $name));
    }
}
