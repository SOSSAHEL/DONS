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
use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
/**
 * Customer Sonata Admin Configuration
 *
 * @since 2.5 Admin in now in CoreBundle
 */
class IntentAdmin extends Admin
{
    protected $baseRoutePattern = 'intents';
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
            ->add('id', 'identifier')
            ->add('customer.firstName')
            ->add('customer.lastName')
            ->add('type')
            ->add('affectationCode')
            ->add('amount')
            ->add('status')
            ->add('paymentMethod')
            ->add('changedAt')
            ->add('campaign')
            ->add('payments')
            ->end()
        ;
    }
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('customer.firstName')
            ->add('customer.lastName')
            ->add('type')
            ->add('affectationCode')
            ->add('amount')
            ->add('paymentMethod')
            ->add('changedAt')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('customer.firstName')
            ->add('customer.lastName')
            ->add('type')
            ->add('affectationCode')
            ->add('amount')
            ->add('paymentMethod')
            ->add('changedAt')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, array(
                'route' => array('name' => 'edit'),
            ))
            ->add('amount')
            ->add('changedAt')
            ->add('status')
            ->add('paymentMethod')

            ->addIdentifier('customer.firstName', null, array(
                'route' => array('name' => 'show'),
            ))
            ->addIdentifier('customer.lastName', null, array(
                'route' => array('name' => 'show'),
            ))
            ->addIdentifier('customer.email')
            ->add('customer.phone')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show', 'export', 'edit'));
    }

    /*
    protected function configureTabMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $menu->addChild($this->trans('Front Office'), array(
            'uri' => $this->generateUrl('list', []),
        ));
    }
    */
}
