<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity;
use IDCI\Bundle\SimpleScheduleBundle\Repository\StatusRepository;
use IDCI\Bundle\SimpleScheduleBundle\Form\EventListener\RecurFieldSubscriber;

abstract class CalendarEntityType extends AbstractType
{
    abstract public function getEntityDiscr();

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new RecurFieldSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);

        $discr = $this->getEntityDiscr();

        $builder
            ->add('summary')
            ->add('categories')
            ->add('startAt', 'datetime', array(
                'data'    => new \DateTime('now'),
                'years'   => range(date('Y')-1, date('Y')+5),
                'minutes' => range(0, 59, 5)
            ))
            ->add('options', 'choice', array(
                'choices' => array(
                    'all_day' => 'All the day',
                    'is_recur' => 'Recurrence'
                ),
                'multiple' => true,
                'expanded' => true
            ))
            ->add('includedRule', new RecurType(), array(
                'required' => false
            ))
            ->add('url')
            ->add('description')
            ->add('status', 'entity', array(
                'class'         => 'IDCISimpleScheduleBundle:Status',
                'query_builder' => function(StatusRepository $sr) use($discr) {
                    return $sr->getDiscrStatusQueryBuilder($discr);
                }
            ))
            ->add('classification', 'choice', array(
                'choices'  => CalendarEntity::getClassifications(),
                'multiple' => false,
                'expanded' => true
            ))
            ->add('comment')
            ->add('organizer')
            ->add('contacts')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity'
        ));
    }

    public function getName()
    {
        return 'idci_simpleschedule_calendarentity_type';
    }
}
