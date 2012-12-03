<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Recur;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurType;

class YearlyRecurType extends RecurType
{
    public function buildSpecificRecurForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('byYearday', 'year_days', array(
                'required' => true
            ))
            ->add('byMonth', 'month', array(
                'required' => true
            ))
        ;
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_yearlyrecurtype';
    }
}
