<?php

namespace Quelp\StatusBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB\Bundle\dbBundle\Entity\Post;
use DB\Bundle\dbBundle\Entity\PostSolution;
use DB\Bundle\dbBundle\Entity\Partner;

class DefaultController extends Controller
{

    public function showAction()
    {
        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $token = $security ->getToken();  // Si la requête courante n'est pas derrière un pare-feu, $token est null
        $userAccount = $token->getUser();// Sinon , on récupère l'utilisateur
        $request = $this->container->get('request');
        $em = $this->getDoctrine()->getManager();
        $lesson = array();

        if( $request->isXmlHttpRequest() )
        {
            $query = $em->createQuery(
                        "SELECT po
                         FROM DBdbBundle:Post po
                         LEFT JOIN DBdbBundle:Partner p WITH po.user = p.user OR po.user = p.user_partner
                         WHERE (p.user = ?1 or p.user_partner = ?1) AND p.active = 1
                         GROUP BY po.id
                         ORDER BY po.editDate DESC"
                     );
            $query->setParameter(1, $userAccount);
            $lesson = $query->getResult();

            for ($i = 0; $i < count($lesson); $i++) {
                $post_comment = $this->getDoctrine()
                    ->getRepository('DBdbBundle:PostSolution')->findByPost($lesson[$i]);
                $comment[$i] = $post_comment;
            }

        }
        return $this->container->get('templating')->renderResponse(
                'StatusBundle:Default:index.html.twig', array('user_lesson' => $lesson, 'post_comment' => $comment));
    }

    public function addAction()
    {
        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $request = $this->get('request');
        $token = $security ->getToken();
        $userAccount = $token->getUser();
        $em = $this->getDoctrine() ->getManager();
        $post = "";

        if ($request ->getMethod() =='POST') {
                $post = $request->request->get('post');

                if ($post != "") {
                    $post_obj = new Post();
                    $post_obj->setUser($userAccount);
                    $post_obj->setSubject($post);

                    $em->persist($post_obj);
                    $em->flush();
                }
         }
         return $this->redirect( $this->generateUrl('fos_user_security_login'));
    }


    public function commentAddAction()
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
            $id_post = $request->request->get('post');

            if($commentText != '')
            {
                $post = $em->getRepository('DBdbBundle:Post') ->findById($id_post);

                $comment = new PostSolution();
                $comment->setSubject($commentText);
                $comment->setUser($userAccount);
                $comment->setPost($post[0]);

                $em->persist($comment);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }

}