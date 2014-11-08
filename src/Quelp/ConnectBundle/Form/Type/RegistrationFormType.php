<?php

namespace Quelp\ConnectBundle\Form\Type;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Options;

class RegistrationFormType extends AbstractType
{
    /*public function registerAction(Request $request)
    {

        return $this->render('FOSUserBundle:Registration:register.html.twig', array());
        //return $this->render('QuelpConnectBundle:Registration:register.html.twig', array());
    }*/
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('job');
        $builder->add('name');
        $builder->add('surname');
        $builder->add('bornDate', 'date', array('input'  => "datetime",
                        'widget' => 'choice',
                        'years' => range(1950,2015),
                        'format' => 'dd  /  MM  /  yyyy',
                        'empty_value' => '',
                        'label'=>'Date of Birth:'));
    }

   public function getParent()
    {
        return 'fos_user_registration';

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DB\Bundle\dbBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'acme_user_registration';
    }
}
