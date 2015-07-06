<?php
/**
 *
 * @author  Sylvain Gogel <sgogel@ecedi.fr>
 * @copyright 2015 Ecedi
 * @package eDonate
 *
 */

namespace Ecedi\Donate\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Customer Sonata Admin Configuration
 *
 * @since 2.5 Admin in now in CoreBundle
 */
class CustomerAdmin extends Admin
{
    protected $baseRoutePattern = 'customers';
    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id',
    );

    protected function configureShowFields(ShowMapper $showMapper)
    {
        // Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
        $showMapper
            ->add('civility')
            ->add('firstName')
            ->add('lastName')
            ->add('id', 'identifier')
            ->add('remoteId')
            ->add('birthday', 'date')
            ->add('phone')
            ->add('email', 'url', array(
                'hide_protocol' => true,
                'url' => 'mailto://',
            ))
            ->add('company')
            ->add('addressLiving')
            ->add('addressNber')
            ->add('addressStreet')
            ->add('addressExtra')
            ->add('addressPb')
            ->add('addressZipcode')
            ->add('addressCity')
            ->add('addressCountry')
            ->add('intents', 'sonata_type_collection', [
                    'label' => 'Intents',
                    'required' => false,
                    'cascade_validation' => true,
                    'associated_property' => 'amount',
                    'by_reference' => false,
                    'template' => 'DonateCoreBundle:Admin:Customer/intents.html.twig',
                ],
                ['edit' => 'inline', 'inline' => 'table'])
            ->end()
        ;
    }
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', 'text', array('label' => 'First name'))
            ->add('lastName', 'text', array('label' => 'Last name'))
            ->add('email', 'text', array('label' => 'Email'))
            ->add('phone', 'text', array('label' => 'Phone'))
            ->add('addressZipcode', 'text', array('label' => 'Zipcode'))
            ->add('addressCity', 'text', array('label' => 'City'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('addressZipcode')
            ->add('addressCity')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('firstName')
            ->addIdentifier('lastName')
            ->addIdentifier('email')
            ->add('phone')
            ->add('addressZipcode')
            ->add('addressCity')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                ),
            ))

        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show'));
    }
}
