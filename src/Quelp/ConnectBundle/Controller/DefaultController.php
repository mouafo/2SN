<?php

namespace Quelp\ConnectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function logoutAction()
    {
    	$securityContext = $this->container->get('security.context');
		$token = $securityContext ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();
		$userAccount->setConnected(FALSE);
		$em = $this->getDoctrine() ->getManager();
        $em->persist($userAccount);
        $em->flush();
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }
}
