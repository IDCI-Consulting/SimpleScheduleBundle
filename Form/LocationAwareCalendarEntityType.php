<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class LocationAwareCalendarEntityType extends CalendarEntityType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location')
        ;

        parent::buildForm($builder, $options);

        $builder
            ->add('duration')
            ->add('priority')
            ->add('resources')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\SimpleScheduleBundle\Entity\LocationAwareCalendarEntity'
        ));
    }

    public function getName()
    {
        return 'idci_simpleschedule_event_type';
    }
}
