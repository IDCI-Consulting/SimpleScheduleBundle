<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity;
use IDCI\Bundle\SimpleScheduleBundle\Repository\StatusRepository;

abstract class CalendarEntityType extends AbstractType
{
    abstract public function getEntityDiscr();

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $discr = $this->getEntityDiscr();

        $builder
            ->add('summary')
            ->add('categories')
            ->add('startAt', 'datetime', array(
                'data'    => new \DateTime('now'),
                'years'   => range(date('Y')-1, date('Y')+5),
                'minutes' => range(0, 59, 5)
            ))
        ;

        $this->buildFormDetails($builder, $options);

        $builder
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

    public function buildFormDetails($builder, $options)
    {
        $builder
            ->add('url')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntityEvent'
        ));
    }

    public function getName()
    {
        return 'idci_simpleschedule_calendarentity_type';
    }
}
