<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {

        return $this->render('BackendAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
