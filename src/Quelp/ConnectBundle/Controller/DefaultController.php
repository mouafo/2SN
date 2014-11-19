<?php

namespace Quelp\ConnectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	$securityContext = $this->container->get('security.context');
		if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('QuelpConnectBundle:Messagerie');

        return $this->render('QuelpConnectBundle:Default:index.html.twig', array('name' => $name));
    }
}
