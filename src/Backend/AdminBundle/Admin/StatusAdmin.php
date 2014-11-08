<?php
namespace Backend\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class StatusAdmin extends Admin
{
  // Fields to be shown on create/edit forms
  protected function configureFormFields(FormMapper $formMapper)
  {
        $formMapper
          ->add('subject')
          ->add('user')
          ->add('createDate')
          ->add('editDate')
	  ;
  }

  // Fields to be shown on filter forms
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
        $datagridMapper
          ->add('user')
          ->add('subject')
	  ;
  }

  // Fields to be shown on lists
  protected function configureListFields(ListMapper $listMapper)
  {
        $listMapper
          ->add('user', 'text', array('label' => 'User', 'required' => false))
          ->add('subject', 'text', array('label' => 'Subject', 'required' => false))
          ->add('createDate')
	  ;
  }
}