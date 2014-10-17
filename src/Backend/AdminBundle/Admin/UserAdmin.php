<?php
namespace Backend\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
  // Fields to be shown on create/edit forms
  protected function configureFormFields(FormMapper $formMapper)
  {
        $formMapper
	  ->add('username', 'text', array('label' => 'username'))
	  ->add('name')
          ->add('state')
          ->add('bornDate')
	  ->add('surname')
          ->add('createDate')
	  ->add('job')
          ->add('lastLogin')
	  ->add('email')
          ->add('editDate')
	  ;
  }

  // Fields to be shown on filter forms
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
        $datagridMapper
          ->add('username')
	  ->add('name')
          ->add('state')
          ->add('bornDate')
          ->add('surname')
          ->add('createDate')
          ->add('job')
          ->add('loginDate')
          ->add('email')
          ->add('editDate')
	  ;
  }

  // Fields to be shown on lists
  protected function configureListFields(ListMapper $listMapper)
  {
        $listMapper
          ->addIdentifier('username')
	  ->add('name')
          ->add('state')
          ->add('bornDate')
          ->add('surname')
          ->add('createDate')
          ->add('job')
          ->add('loginDate')
          ->add('email')
          ->add('editDate')
	  ;
  }
}