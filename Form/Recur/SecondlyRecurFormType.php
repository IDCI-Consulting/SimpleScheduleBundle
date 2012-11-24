<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Recur;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

namespace IDCI\Bundle\SimpleScheduleBundle\Form\RecurType;

class SecondlyRecurType extends RecurType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_secondlyrecurtype';
    }
}
