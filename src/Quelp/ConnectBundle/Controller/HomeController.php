<?php

namespace Quelp\ConnectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DB\Bundle\dbBundle\Entity\Partner;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

    	$request = $this->get('request');  // On récupère le service
		$token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();// Sinon , on récupère l'utilisateur
		$em = $this->getDoctrine() ->getManager();
		$partners = $em->getRepository('DBdbBundle:Partner') ->findUserPartners($userAccount);
		$userPartners = array();
		if($request->isXmlHttpRequest())
        {
			for ($i=0; $i<count($partners); $i++) {
				if ($partners[$i]->getUser()->getId() == $userAccount->getId()) {
					$userPartners[$i] = $partners[$i]->getUserPartner();
				}
				else {
					$userPartners[$i] = $partners[$i]->getUser();
				}
			}
			$j = 0;
			$userOut = array();
			$userConnected = array();
			for ($i=0; $i<count($userPartners); $i++) {
				if ($userPartners[$i]->getConnected() == TRUE) {
					$userConnected[$i] = $userPartners[$i];
				}
				else {
					if (count($userOut) < 6) {
						$userOut[$j] = $userPartners[$i];
						$j = $j + 1;
					}
				}
			}
			$user['connected'] = $userConnected;
			$user['out'] = $userOut;
		    return $this->container->get('templating')->renderResponse('QuelpConnectBundle:Common:listUser.html.twig', array(
                        'usersConnected' => $user));
        }
        else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

    public function searchConnectedAction()
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

    	$request = $this->get('request');  // On récupère le service
		$token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();// Sinon , on récupère l'utilisateur
		$em = $this->getDoctrine() ->getManager();
		$partners = $em->getRepository('DBdbBundle:Partner') ->findUserPartners($userAccount);
		$userPartners = array();
		if($request->isXmlHttpRequest())
        {
        	$Text = $request->request->get('Text');
			for ($i=0; $i<count($partners); $i++) {
				if ($partners[$i]->getUser()->getId() == $userAccount->getId()) {
					$userPartners[$i] = $partners[$i]->getUserPartner();
				}
				else {
					$userPartners[$i] = $partners[$i]->getUser();
				}
			}
			$j = 0;
			$userOut = array();
			$userConnected = array();
			for ($i=0; $i<count($userPartners); $i++) {
				if ($userPartners[$i]->getConnected() == TRUE) {
					if (strpos($userPartners[$i]->getUsername(), $Text) !== false) {
						$userConnected[$i] = $userPartners[$i];
					}
				}
				else {
					if (strpos($userPartners[$i]->getUsername(), $Text) !== false) {
						$userOut[$j] = $userPartners[$i];
						$j = $j + 1;
					}
				}
			}
			$user['connected'] = $userConnected;
			$user['out'] = $userOut;
		    return $this->container->get('templating')->renderResponse('QuelpConnectBundle:Common:listUser.html.twig', array(
                        'usersConnected' => $user));
        }
        else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

}
