<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Recur;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurType;

class MonthlyRecurType extends RecurType
{
    public function buildSpecificRecurForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('byMonth', 'month', array(
                'required' => true
            ))
            ->add('byMonthday', 'month_days', array(
                'required' => true
            ))
        ;
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_monthlyrecurtype';
    }
}
