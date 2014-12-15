<?php

namespace Quelp\StatusBundle\Controller;


use DB\Bundle\dbBundle\Entity\PostSolution;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DB\Bundle\dbBundle\Entity\Post;

class DefaultController extends Controller
{

    public function addAction(Request $request)
    {
        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        /// en ce qui concerne le status

        $new_post = new Post();
        $token = $security->getToken();
        $user = $token->getUser();
        $new_post->setUser($user);
        $use = $new_post->setUser($user);


        $form = $this->createFormBuilder($new_post)
            ->add('subject', 'text')
            ->add('save', 'submit')
            ->getForm();

       $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_post);
            $em->flush();
        }
        $user_lesson = $this->getDoctrine()
            ->getRepository('DBdbBundle:Post')->findUserPost($user);


    return $this->render('StatusBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'user_lesson' => $user_lesson,
        ));
    }
    /*public function addCommentAction(Request $request)
    {
        /// en ce qui concerne les commentaires
        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $post_solution = new PostSolution();
        $token = $security->getToken();

        //set user
        $user = $token->getUser();
        $post_solution->setUser($user);

        //set post
        $post = $token->getPost();
        $post_solution->setPost($post);


        $form_comment = $this->createFormBuilder($post_solution)
            ->add('subject', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form_comment->handleRequest($request);

        if ($form_comment->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post_solution);
            $em->flush();
        }
        $comment = $this->getDoctrine()
            ->getRepository('DBdbBundle:PostSolution')->findcomment();

        return $this->render('StatusBundle:Default:index.html.twig', array(
            'form_comment' => $form_comment->createView(),
            'comment' => $comment,
        ));
    }*/

}