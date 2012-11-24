<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('startAt')
            ->add('lastModifiedAt')
            ->add('summary')
            ->add('description')
            ->add('comment')
            ->add('url')
            ->add('organizer')
            ->add('revisionSequence')
            ->add('contacts')
            ->add('excludedDates')
            ->add('includedDates')
            ->add('xProp')
            ->add('classification')
            ->add('priority')
            ->add('resources')
            ->add('duration')
            ->add('isTransparent')
            ->add('endAt')
            ->add('status')
            ->add('categories')
            ->add('includedRules')
            ->add('excludedRules')
            ->add('location')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\SimpleScheduleBundle\Entity\Event'
        ));
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_eventtype';
    }
}
