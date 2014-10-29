<?php

namespace Quelp\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlbumController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuelpImageBundle:Gallerie:album.html.twig', array());
    }
}
