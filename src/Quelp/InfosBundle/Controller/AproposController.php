<?php

namespace Quelp\InfosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AproposController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpInfosBundle:Default:apropos.html.twig', array());
    }
}
