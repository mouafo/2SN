<?php

namespace Quelp\InfosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TermsofserviceController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpInfosBundle:Default:termsofservice.html.twig', array());
    }
}