<?php

namespace Quelp\ConnectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$securityContext = $this->container->get('security.context');
		if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}
        return $this->render('QuelpConnectBundle:Home:home.html.twig', array());
    }
}
