<?php

namespace Quelp\RelationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpRelationBundle:Default:index.html.twig');
    }
}
