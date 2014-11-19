<?php

namespace Quelp\InfosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrivacypolicyController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpInfosBundle:Default:privacypolicy.html.twig', array());
    }
}