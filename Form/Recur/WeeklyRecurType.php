<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Recur;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurType;

class WeeklyRecurType extends RecurType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('byDay', 'week_days')
        ;
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_weeklyrecurtype';
    }
}
