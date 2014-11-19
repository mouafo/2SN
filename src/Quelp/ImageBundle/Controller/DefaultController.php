<?php

namespace Quelp\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DB\Bundle\dbBundle\Entity\Multimedia;
use DB\Bundle\dbBundle\Form\MultimediaType;

class DefaultController extends Controller
{
    public function AddAction()
    {
    	$Image = new Multimedia();
    	$form = $this->CreateForm(new MultimediaType, $Image);

    	$request = $this->get('request');
    	if ($request ->getMethod() == 'POST') {
    		$form->bind($request);
    		if ($form->IsValid()) {
    			$em = $this->getDoctrine() ->getManager();
    			$em->persist($Image);
				$em->flush();
				//return $this->redirect( $this->generateUrl('quelp_image_murpage'));
    		}
    	}
    	var_dump($Image);

        return $this->render('QuelpImageBundle:Default:index.html.twig', array('img_form' => $form->createView(),'img' => $Image));
    }
}
