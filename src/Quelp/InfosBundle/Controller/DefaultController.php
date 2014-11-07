<?php

namespace Quelp\InfosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpInfosBundle:Default:index.html.twig', array());
    }
}
