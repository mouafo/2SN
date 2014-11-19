<?php

namespace Quelp\ImageBundle\Images;

class ImagesCrud
{
    $security = $this->container->get('security.context');
    if (!$security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }



}