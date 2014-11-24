<?php

namespace Quelp\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DB\Bundle\dbBundle\Entity\Multimedia;
use DB\Bundle\dbBundle\Entity\Album;
use DB\Bundle\dbBundle\Form\MultimediaType;
use DB\Bundle\dbBundle\Form\AlbumType;

class ImageController extends Controller
{
    public function indexAction()
    {
    	$security = $this->container->get('security.context');
		if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
		    return $this->redirect($this->generateUrl('fos_user_security_login'));
		}

		$token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
		$userAccount = $token->getUser();// Sinon , on récupère l'utilisateur
		$em = $this->getDoctrine() ->getManager();
		$request = $this->get('request');

		if ($request->query->get('id') != null) {
			$id = $request->query->get('id');
    		$album = $em->getRepository('DBdbBundle:Album') ->findById($id);

		    $Image = new Multimedia();
		   	$Image ->setUser($userAccount);
		   	$Image ->setAlbum($album[0]);
			$formImg = $this->CreateForm(new MultimediaType, $Image);

	    	if ($request ->getMethod() == 'POST') {

	    		$formImg->bind($request);
	    		if ($formImg->IsValid()) {
	    			$em->persist($Image);
					$em->flush();
	    		}
	    	}
		
	    	$list_img = $em->getRepository('DBdbBundle:Multimedia') ->findByAlbums($userAccount, $album);
	    	$list_album = $em->getRepository('DBdbBundle:Album') ->findByUser($userAccount);

	        return $this->render('QuelpImageBundle:Gallerie:image.html.twig', array(
	        						'img_form' => $formImg->createView(),
	        						'list_img' => $list_img,
	        						'list_album' => $list_album,
	        						'def_albumId' => $id));
        }
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }

    public function editAction() {

        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $request = $this->get('request');
        $token = $security ->getToken();
        $userAccount = $token->getUser();
        $em = $this->getDoctrine() ->getManager();

        if ($request->query->get('id') != null) {
            $id = $request->query->get('id');
            $image = $em->getRepository('DBdbBundle:Multimedia') ->findById($id);

            if ($request ->getMethod() =='POST') {
                $album = $request->request->get('list_album');
                $album = $em->getRepository('DBdbBundle:Album') ->findById($album);
                $image[0]->setAlbum($album[0]);
                $image[0]->setEditDate(new \Datetime());
                $em->persist($image[0]);
                $em->flush();
               // return new Response('Album(s) deleted successfully');
            }
        }
        return $this->forward('QuelpImageBundle:Albums:index');
    }

    public function deleteAction() {

        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $request = $this->get('request');
        $em = $this->getDoctrine() ->getManager();

        if ($request ->getMethod() =='POST') {
            for ($i = 0; isset($request->request->get('box')[$i]); $i++ ) {
                $boxes = $request->request->get('box')[$i];
                $list_img = $em->getRepository('DBdbBundle:Multimedia') ->findById($boxes);
                $em->remove($list_img[0]);
            }
            $em->flush();
           // return new Response('Album(s) deleted successfully');
        }
        return $this->forward('QuelpImageBundle:Image:index', array('request' => $request));
    }
}
