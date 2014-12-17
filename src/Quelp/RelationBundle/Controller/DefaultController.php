<?php

namespace Quelp\RelationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function showwaitingAction()
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

		$request = $this->get('request');  // On récupère le service
		$token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();// Sinon , on récupère l'utilisateur

		$em = $this->getDoctrine() ->getManager();
		$userAccount = $em->getRepository('DBdbBundle:User') ->findById($userAccount->getId());
		$partners = $em->getRepository('DBdbBundle:Partner') ->findWaitingPartners($userAccount[0]);

		$userPartners = array();
		
		for ($i=0; $i<count($partners); $i++) {
				$userPartners[$i] = $partners[$i]->getUser();
		}

        return $this->render('QuelpRelationBundle:Search:waitingpartners.html.twig', array('users_found' => $userPartners));
    }

    public function acceptAction()
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

		$request = $this->get('request');
		$token = $security ->getToken();
		$userAccount = $token->getUser();

		$em = $this->getDoctrine() ->getManager();
		if ($request ->getMethod() =='GET') {
			$request = $this->getRequest();
			$id = $request->query->get('id');
			$userAccount = $em->getRepository('DBdbBundle:User') ->findById($userAccount->getId());
			$userPartner = $em->getRepository('DBdbBundle:User') ->findById($id);
			$partner = $em->getRepository('DBdbBundle:Partner') ->findWaitingPartner($userPartner, $userAccount);
			if (count($partner) == 0) {
				throw $this->createNotFoundException('User[id='.$id.'] has not sent any partnership request');
			}
			else {
				$partner[0]->setActive(TRUE);
				$partner[0]->setEditDate(new \Datetime());
				$em->persist($partner[0]);
				$em->flush();
			}
		}
        return $this->forward('QuelpRelationBundle:Search:index');
    }

    public function deleteAction() // non tester neanmoins a premiere vu est fonctionnelle
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

		$request = $this->get('request');
		$userAccount = $token->getUser();

		$em = $this->getDoctrine() ->getManager();
		if ($request ->getMethod() =='GET') {
			$request = $this->getRequest();
			$id = $request->query->get('id');
			$userAccount = $em->getRepository('DBdbBundle:User') ->findById($userAccount->getId());
			$userPartner = $em->getRepository('DBdbBundle:User') ->findById($id);
			// Case where the user don't want to accept the partnership. (request still on hold)
			$partner = $em->getRepository('DBdbBundle:Partner') ->findWaitingPartner($userPartner, $userAccount);
			if (count($partner) == 0) {
				// Case where the user wants to delete partnership (I first was the one to accept the request)
				$partner = $em->getRepository('DBdbBundle:Partner') ->findPartner($userPartner, $userAccount);
				if (count($partner) == 0) {
					// Case where the user wants to delete partnership (I first was the one to send the request)
					$partner = $em->getRepository('DBdbBundle:Partner') ->findPartner($userAccount, $userPartner);
					if (count($partner) == 0) {
						throw $this->createNotFoundException('User[id='.$id.'] has not sent any partnership request');
					}
					else {
						$em->remove($partner[0]);
					}
				}
				else {
					$em->remove($partner[0]);
				}
			}
			else {
				$em->remove($partner[0]);
			}
			$em->flush();
		}
        return $this->render('QuelpRelationBundle:Default:index.html.twig');
    }
}
