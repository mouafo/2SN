<?php

namespace Quelp\StatusBundle\Controller;

use DB\Bundle\dbBundle\Entity\Lessons;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//$uri = $_SERVER['REQUEST_URI'];

//echo $uri;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $task = new Lessons();
        //$task->setSubject('coucou les gens');
        //$task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('subject', 'text')
            ->add('save', 'submit')
            ->getForm();

       //$hey = $request->getPathInfo();
        //echo $hey;

       $form->handleRequest($request);
        var_dump($task);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $task->getId())));

        }

        return $this->render('StatusBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
