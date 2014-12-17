<?php

namespace Quelp\MessageBundle\Controller;

use DB\Bundle\dbBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DB\Bundle\dbBundle\Entity\Message;


class MessageController extends Controller
{
    public function indexAction()
    {

        $all_users = $this->getDoctrine()->getRepository('DBdbBundle:User')->findAll();//findByNameorSurname($name);

        $user_content_message = $this->getDoctrine()->getRepository('DBdbBundle:Message')->findAll();

        if (!$user_content_message)
            return ($this->render('QuelpMessageBundle:Message:home_message.html.twig', array('users_message' => '', 'user_content_message' => '')));


        if (!($all_users))
        {
            $all_users = "Aucun utilisateur";
        }
        return ($this->render('QuelpMessageBundle:Message:home_message.html.twig', array('users_message' => $all_users, 'user_content_message' => $user_content_message)));
    }

    public function listMessageAction(Request $request, $name)
    {

        $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $user_message = $this->getDoctrine()->getRepository('DBdbBundle:User')->findOneBy(array('username' => $name));
        if (!($user_message))
        {
            $user_message = "Aucun utilisateur";
        }


        $message = new Message();

        $token = $security->getToken();
        $user = $token->getUser();
        $message->setSender($user);
        $message->setReceiver($user_message);

        $form = $this->createFormBuilder($message)
            ->add('subject', 'textarea', array(
                'attr' => array('class' => 'form-control',
                    'placeholder' => 'Type your text here')
            ))
            ->add('submit', 'submit', array(
                'attr' => array('class' => 'btn btn-default btn-msg')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }

        $user_test =  $this->getDoctrine()->getRepository('DBdbBundle:Message')->getAllSubject($user, $user_message);

        return $this->render('QuelpMessageBundle:Message:message.html.twig', array(
            'form' => $form->createView(),
            'name_user_message' => $name,
            'user_test' => $user_test,
        ));
    }


    public function findReceiverAction()
    {
        $em = $this->getDoctrine()->getManager();
        $name_receiver = $em->getRepository('DBdbBundle:User')->findAllUserByName();
        $response = new JsonResponse();
        return $response->setData(array('name_receiver' => $name_receiver));

    }

    public function sendMessageAction($name)
    {

    }

    public function receiveMessageAction()
    {

    }
    public function newMessageAction(Request $request)
    {
 /*       $security = $this->container->get('security.context');
        if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }


        $message = new Message();


        $token = $security->getToken();
        $user = $token->getUser();
        $message->setSender($user);
        $message->setReceiver($user);


        $form = $this->createFormBuilder($message)
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => 'Type your message here',
                    'class' => 'new-message-form form-control input-sm',
                    'id' => 'btn-input'
                )))
            ->add('send', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-warning btn-sm'
                )
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

        }

        $user_message = $this->getDoctrine()->getRepository('DBdbBundle:User')->findAll();
        if (!($user_message))
        {
            die("Pas d'utilisateur trouvé");
        }

        $form_send_message = $this->createFormBuilder($user_message)
            ->add('username', 'text', array(
                'attr' => array(
                    'placeholder' => 'Type your contact here',
                    'class' => 'new-sender-form form-control input-sm',
                    'id' => 'btn-input'
                )))
            ->add('send', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-warning btn-sm'
                )
            ))
            ->getForm();

        $form_send_message->handleRequest($request);

        if ($form_send_message->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

        }

        return $this->render('QuelpMessageBundle:Message:new_message.html.twig', array(
            'form' => $form->createView(),
        ));*/
    }
}
