<?php
namespace Backend\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends Admin
{
  // Fields to be shown on create/edit forms
  protected function configureFormFields(FormMapper $formMapper)
  {
    //    if ($this->admin->isGranted('ADD')) {
        $formMapper
	  ->add('username', 'text', array('label' => 'username', 'required' => true))
	  ->add('email', 'email', array('required' => true))
	  ->add('password', 'password', array('required' => true))
	  ->add('name', null, array('required' => false))
	  ->add('surname', null, array('required' => false))
	  ->add('job')
          ->add('locked', null, array('required' => false))
          ->add('bornDate')
	  ;
	//   }
  }

  // Fields to be shown on filter forms
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
        $datagridMapper
          ->add('username')
          ->add('locked')
          ->add('surname')
          ->add('createDate')
          ->add('job')
          ->add('email')
	  ;
  }

  // Fields to be shown on lists
  protected function configureListFields(ListMapper $listMapper)
  {
    //    if ($this->admin->isGranted('LIST')) {
        $listMapper
          ->addIdentifier('username')
          ->add('email')
          ->add('locked')
          ->add('createDate')
          ->add('lastLogin')
	  ->add('_action', 'actions', array(
	     'actions' => array(
				//  'Partners' => array('template' => 'SonataAdminBundle:CRUD:base_list.html.twig'),
                  'edit' => array(),
                  'delete' => array(),
	      )
          ))
	  ;
	//    }
  }
}