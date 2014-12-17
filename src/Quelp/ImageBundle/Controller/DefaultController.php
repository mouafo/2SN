<?php

namespace Quelp\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DB\Bundle\dbBundle\Entity\Multimedia;
use DB\Bundle\dbBundle\Form\MultimediaType;
use DB\Bundle\dbBundle\Entity\MultimediaComment;
use DB\Bundle\dbBundle\Entity\User;
use DB\Bundle\dbBundle\Form\UserType;

class DefaultController extends Controller
{
    public function AddAction()
    {
        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
        $userAccount = $token->getUser();// Sinon , on récupère l'utilisateur
        $em = $this->getDoctrine() ->getManager();
        $request = $this->container->get('request');

    	if($request->isXmlHttpRequest())
        {
            $commentText = $request->request->get('commentText');
            $id_img = $request->request->get('img');
            $id_user = $request->request->get('userCreate');

            if($commentText != '')
            {
                $user = $em->getRepository('DBdbBundle:User') ->findById($id_user);
                $img = $em->getRepository('DBdbBundle:Multimedia') ->findById($id_img);
                $comment = new MultimediaComment();
                $comment->setUser_comment($userAccount);
                $comment->setUser_create($user[0]);
                $comment->setMultimedia($img[0]);
                $comment->setComment($commentText);

                $em->persist($comment);
                $em->flush();

                $comments = $em->getRepository('DBdbBundle:MultimediaComment') ->findByMultimedia($img);
            } 
            else {
                $comments = $em->getRepository('DBdbBundle:MultimediaComment') ->findByMultimedia($img);
            }
            return $this->container->get('templating')->renderResponse('QuelpImageBundle:Default:index.html.twig', array(
                        'comments' => $comments));
        }
        else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }
}
