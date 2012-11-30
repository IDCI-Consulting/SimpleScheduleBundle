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
            ->add('categories')
            ->add('url')
            ->add('description')
            ->add('summary')
            ->add('startAt')
            ->add('status', 'entity', array(
                'class'         => 'IDCISimpleScheduleBundle:Status',
                'query_builder' => function(StatusRepository $sr) use($discr) {
                    return $sr->getDiscrStatusQueryBuilder($discr);
                }
            ))
            ->add('comment')
            ->add('classification', 'choice', array(
                'choices' => CalendarEntity::getClassifications()
            ))
            ->add('organizer')
            ->add('contacts')
            ->add('xproperties', 'collection', array(
                'type'         => new XPropertyType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ));
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
