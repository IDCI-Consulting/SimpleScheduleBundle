<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Recur;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurType;
use IDCI\Bundle\SimpleScheduleBundle\Entity\Recur;

class WeeklyRecurType extends RecurType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('byDay', 'choice', array(
                'choices'  => Recur::getWeekdays(),
                'multiple' => true,
                'expanded' => true
            ))
        ;
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_weeklyrecurtype';
    }
}
