<?php
namespace Backend\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PartnerAdmin extends Admin
{
  // Fields to be shown on create/edit forms
  protected function configureFormFields(FormMapper $formMapper)
  {
        $formMapper
          ->add('user')
          ->add('user_partner')
          ->add('createDate')
          ->add('editDate')
	  ;
  }

  // Fields to be shown on filter forms
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
        $datagridMapper
          ->add('user')
          ->add('user_partner')
	  ;
  }

  // Fields to be shown on lists
  protected function configureListFields(ListMapper $listMapper)
  {
        $listMapper
          ->add('user', 'text', array('label' => 'User', 'required' => false))
          ->add('user_partner', 'text', array('label' => 'Partner', 'required' => false))
          ->add('active', 'boolean', array('label' => 'PartnerShip Activated', 'required' => false))
          ->add('createDate')
	  ;
  }
}