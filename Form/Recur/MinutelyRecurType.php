<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Recur;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurType;

class MinutelyRecurType extends RecurType
{
    public function buildSpecificRecurForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_minutelyrecurtype';
    }
}
