<?php
/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 23/05/16
 * Time: 14:36
 */

namespace Ens\SylvainDavenelBundle\Admin;

use Ens\SylvainDavenelBundle\Entity\Job;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JobAdmin extends Admin
{
    // setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category')
            ->add('type', ChoiceType::class, array('choices' => Job::getTypes(), 'expanded' => true))
            ->add('company')
            ->add('file', FileType::class, array('label' => 'Company logo', 'required' => false))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('howToApply')
            ->add('isPublic')
            ->add('email')
            ->add('isActivated')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('company')
            ->add('position')
            ->add('description')
            ->add('isActivated')
            ->add('isPublic')
            ->add('email')
            ->add('expiresAt')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('company')
            ->add('position')
            ->add('location')
            ->add('url')
            ->add('isActivated')
            ->add('email')
            ->add('category')
            ->add('expiresAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('category')
            ->add('type')
            ->add('company')
            ->add('webPath', 'string', array('template' => 'EnsSylvainDavenelBundle:JobAdmin:list_image.html.twig'))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('howToApply')
            ->add('isPublic')
            ->add('isActivated')
            ->add('token')
            ->add('email')
            ->add('expiresAt')
        ;
    }
}