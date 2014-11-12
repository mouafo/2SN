<?php

namespace Quelp\InfosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$securityContext = $this->container->get('security.context');
		if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}
        return $this->render('QuelpInfosBundle:Default:index.html.twig', array());
    }
}
