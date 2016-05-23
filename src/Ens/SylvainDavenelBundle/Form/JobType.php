<?php

namespace Ens\SylvainDavenelBundle\Form;

use Ens\SylvainDavenelBundle\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category');
        $builder->add('type', ChoiceType::class, array(
            'choices' => Job::getTypes(),
            'expanded' => true,
            'choices_as_values' => true,)
        );
        $builder->add('company');
        $builder->add('file', FileType::class, array('label' => 'Company logo', 'required' => false));
        $builder->add('url');
        $builder->add('position');
        $builder->add('location');
        $builder->add('description');
        $builder->add('howToApply', null, array('label' => 'How to apply?'));
        $builder->add('isPublic', null, array('label' => 'Public?'));
        $builder->add('email');
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ens\SylvainDavenelBundle\Entity\Job'
        ));
    }

    public function getBlockPrefix()
    {
        return 'job';
    }
}
