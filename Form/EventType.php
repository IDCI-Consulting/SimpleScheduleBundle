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

use IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity;

class EventType extends LocationAwareCalendarEntityType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('isTransparent', null, array(
                'required' => false
            ))
        ;
    }

    public function getEntityDiscr()
    {
        return CalendarEntity::EVENT;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\SimpleScheduleBundle\Entity\Event'
        ));
    }

    public function getName()
    {
        return 'idci_simpleschedule_event_type';
    }
}
