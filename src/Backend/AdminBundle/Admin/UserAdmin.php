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
          ->with('Account Manager', array('class' => 'col-md-12'))
                  ->add('username', 'text', array('label' => 'username', 'required' => true))
          ->end()
          ->with('User Personal data', array( 'class' => 'col-md-6' ))
                ->add('name', 'text', array('required' => false))
                ->add('surname', 'text', array('required' => false)) 
                ->add('email', 'email', array('required' => true))
                ->add('password', 'text', array('required' => true, 'read_only'=> 'read_only'))
                
          ->end()
          ->with('User\'s Account State', array( 'class' => 'col-md-6' ))
                ->add('bornDate', 'date', array('input'  => "datetime",
                              'widget' => 'choice',
                              'years' => range(1950,2015),
                              'format' => 'dd / MM / yyyy',
                              'empty_value' => '',
                              'label'=>'Date of Birth:'))
                ->add('job')
                ->add('locked', null, array('required' => false))
                ->add('roles', 'choice', array(
                                'choices'   => array(
                                    'ROLE_USER'   => 'ROLE_USER',
                                    'ROLE_STAFF'        => 'ROLE_STAFF',
                                    'ROLE_SONATA_FOO_READER'        => 'ROLE_SONATA_FOO_READER',
                                    'ROLE_SONATA_FOO_EDITOR'        => 'ROLE_SONATA_FOO_EDITOR',
                                    'ROLE_SONATA_FOO_ADMIN'        => 'ROLE_SONATA_FOO_ADMIN',
                                    'ROLE_ADMIN'        => 'ROLE_ADMIN',
                                    'ROLE_SUPER_ADMIN'        => 'ROLE_SUPER_ADMIN',
                                ),
                                'required' => false,
                                'multiple'  => true,
                ))
          ->end()
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