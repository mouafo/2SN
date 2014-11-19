<?php

namespace Quelp\ConnectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessagerieController extends Controller
{
    public function indexAction()
    {
        $securityContext = $this->container->get('security.context');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        return $this->render('QuelpConnectBundle:Messagerie:tchat.html.twig', array());
    }
}
