<?php


namespace Quelp\RelationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB\Bundle\dbBundle\Entity\Partner;

class SearchController extends Controller
{
    public function indexAction()
    {
    	$request = $this->get('request');
    	$users = "";
    	$name = "aucun";
		if ($request ->getMethod() =='POST') {
				$request = $this->getRequest();
				$name = $request->request->get('name');
				$em = $this->getDoctrine() ->getManager();
				
				$users = $em->getRepository('DBdbBundle:User') ->findByNameOrSurname($name);
				if ($users === null) {
					throw $this->createNotFoundException('User[name='.$name.'] inexistant.');
				}
		
		 }
			// Puis modifiez la ligne du render comme ceci, pour prendre en compte les articleCompetence :
		
        return $this->render('QuelpRelationBundle:Search:index.html.twig', array('users_found' => $users));

    }

  public function demandAction()
    {
    	/*
		** This action deals with a friendship record. it register all partnership requests
		*/

    	$request = $this->get('request');  // On récupère le service
		$security = $this ->get('security.context');  // On récupère le token
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
				->setFrom('quelp@etna-alternance.net')
				->setSubject("Confirm friend request ...")
				->setTo($userFriend[0]->getEmail())
				->setBody("The user ".$userFriend[0]->getName()." ".$userFriend[0]->getSurname()."
				 wants to add you as one of his partner.

				 connect to you account in order to accept his request <a href='http://localhost:8888/2SN/web/app_dev.php/'>Click here</a>");
			$mailer->send($message);

			return new Response('The Partner request has being sent to the user. Wait for confirmation ...');
		 }
	 	else {
	 		return $this->redirect( $this->generateUrl('quelp_image_murpage'));
	 	}
    }

    public function showAction()
    {
    	$request = $this->get('request');  // On récupère le service
		$security = $this ->get('security.context');  // On récupère le token
		$token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();// Sinon , on récupère l'utilisateur


		$em = $this->getDoctrine() ->getManager();
		$userAccount = $em->getRepository('DBdbBundle:User') ->findById($userAccount->getId());
		$partners = $em->getRepository('DBdbBundle:Partner') ->findUserPartners($userAccount[0]);
		
		for ($i=0; $i<count($partners); $i++) {
			if ($partners[$i]->getUser()->getId() == $userAccount[0]->getId()) {
				$userPartners[] = $partners[$i]->getUserPartner();
			}
			else {
				$userPartners[] = $partners[$i]->getUser();
			}
		}
		// Puis modifiez la ligne du render comme ceci, pour prendre en compte les articleCompetence :
		
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