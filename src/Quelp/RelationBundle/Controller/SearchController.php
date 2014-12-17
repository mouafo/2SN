<?php


namespace Quelp\RelationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB\Bundle\dbBundle\Entity\Partner;

class SearchController extends Controller
{
	/*
	** indexAction is an action used to find other users on the social network
	*/
    public function indexAction()
    {
    	/*
		** We test if the user is connected before executing the script. If not, the user is redirected
		** to the login form.
		*/
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

		/*
		** When we identify a user connected, we initialise variables to be used in the script including
		** the user session
		*/
    	$request = $this->get('request');
    	$token = $security ->getToken();
		$userAccount = $token->getUser();
		$em = $this->getDoctrine() ->getManager();
    	$users = "";
    	$name = "aucun";

    	/*
		** The script below is only executed if a search request is being sent through the search form.
		*/
		if ($request ->getMethod() =='POST') {
				$name = $request->request->get('name');
				
				$users = $em->getRepository('DBdbBundle:User') ->findByNameOrSurname($name);
				if (count($users) == 0) {
					return $this->render('QuelpRelationBundle:Search:index.html.twig', array('users_found' => $users));
				}
				
				/*
				** Now users are found, we go through each user found in order to determine if the user connected is 
				** a partner of the user found. the is to avoid duplicate send request.
				*/
				for ($i=0; isset($users[$i]); $i++) {

					$partner[$i] = $em->getRepository('DBdbBundle:Partner') ->findPartner($users[$i], $userAccount);
					if (count($partner[$i]) == 0) {
						$partner[$i] = $em->getRepository('DBdbBundle:Partner') ->findPartner($userAccount, $users[$i]);
						if (count($partner[$i]) == 0) {
							$partner[$i] = $em->getRepository('DBdbBundle:Partner') ->findWaitingPartner($userAccount, $users[$i]);
							if (count($partner[$i]) == 0) {
								$partner[$i] = $em->getRepository('DBdbBundle:Partner') ->findWaitingPartner($users[$i], $userAccount);
								if (count($partner[$i]) == 0) {
									$etat[$i] = "Envoyer demande";
								}
								else {
									$etat[$i] = "confirmation";
								}
							}
							else {
								$etat[$i] = "en attente";
							}
						}
						else {
							$etat[$i] = "Deja partenaire";
						}
					}
					else {
						$etat[$i] = "Deja partenaire";
					}
				}

				/*
				** before rendering the search result, we need to check if the current user is not in the
				** search result. if That's the case, the user is removed before rendering the rest.
				*/
				if(($key = array_search($userAccount, $users)) !== false) {
				    unset($users[$key]);
				    unset($etat[$key]);
				}
				return $this->render('QuelpRelationBundle:Search:index.html.twig', array('users_found' => $users, 'etat' => $etat));
		 }
		 return $this->redirect( $this->generateUrl('fos_user_security_login'));
    }

    /*
	** demandAction is the action the records a partner request and sends a notification to the user concerned 
	*/
  	public function demandAction()
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

    	/*
		** This action deals with a friendship record. it register all partnership requests
		*/
    	$request = $this->get('request');  // On récupère le service
		$token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();// Sinon , on récupère l'utilisateur

		if ($request ->getMethod() =='GET') {
			$request = $this->getRequest();
			$id = $request->query->get('id');
			$em = $this->getDoctrine() ->getManager();

			$userAccount = $em->getRepository('DBdbBundle:User') ->findById($userAccount->getId());
			$userFriend = $em->getRepository('DBdbBundle:User') ->findById($id);
			if ($userFriend === null) {
				throw $this->createNotFoundException('User[id='.$id.'] inexistant.');
			}

			/*
			** The 2 users concerned User and UserPartner, the object partner is contructed and its attributes are set
			** with the current user and the partner he wants to send the demand to. The the object is persisted and 
			** is being stored inside the database throught persist and flush.
			*/
			$partner = new partner();
			$partner ->setUser($userAccount[0]); 
			$partner ->setUserPartner($userFriend[0]);
			$em->persist($partner);
			$em->flush();

			/*
			** After storring the partnership request inside the database, the request message reminder is sent inside
			** the user requested's mail box.
			*/
			$mailer = $this->get('mailer');
			$message = \Swift_Message::newInstance()

				->setFrom('quelp.2sn@gmail.com')
				->setSubject("Confirm friend request ...")
				->setTo($userFriend[0]->getEmail())
				->setBody("The user ".$userFriend[0]->getName()." ".$userFriend[0]->getSurname()."
				 wants to add you as one of his partner.
				 connect to you account in order to accept his request, go to http://localhost:8888/2SN/web/app_dev.php");
			$mailer->send($message);

			return $this->redirect( $this->generateUrl('fos_user_security_login'));
		 }
	 	else {
	 		return $this->redirect( $this->generateUrl('fos_user_security_login'));
	 	}
    }

    public function showAction()
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
		$partners = $em->getRepository('DBdbBundle:Partner') ->findUserPartners($userAccount[0]);
		$userPartners = array();

		for ($i=0; $i<count($partners); $i++) {
			if ($partners[$i]->getUser()->getId() == $userAccount[0]->getId()) {
				$userPartners[$i] = $partners[$i]->getUserPartner();
			}
			else {
				$userPartners[$i] = $partners[$i]->getUser();
			}
		}
        return $this->render('QuelpRelationBundle:Search:partners.html.twig', array('users_found' => $userPartners));

    }
 /* 
    public function removeAction()
    {
    	$request = $this->get('request');
    	$session = $this->get('session');

		if ($request ->getMethod() =='GET') {
			$request = $this->getRequest();
			$userAccount = $session ->get('user');
			$id = $request->query->get('id');
			$em = $this->getDoctrine() ->getManager();

			$userFriend = $em->getRepository('DBdbBundle:User') ->findById($id);
			if ($userFriend === null) {
				throw $this->createNotFoundException('User[id='.$id.'] inexistant.');
			}

			$partner = new partner();
			$partner ->setUser($userAccount); 
			$partner ->setUserPartner($userFriend);
		 }
	 	else {
	 		$session->getFlashBag()->add('info', 'Une erreur est surbenue lors de la demande de partenaire. Veuilleur reessayer plutard ...');
			return $this->redirect( $this->generateUrl('quelp_relation_homepage');
	 	}

    }*/
}