<?php

namespace Quelp\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlbumsController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpImageBundle:Gallerie:albums.html.twig', array());
    }
}