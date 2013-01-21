<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class LocationAwareCalendarEntityType extends CalendarEntityType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('duration', 'duration')
            ->add('location')
            ->add('priority', 'choice', array(
                'choices' => range(0, 9)
            ))
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
