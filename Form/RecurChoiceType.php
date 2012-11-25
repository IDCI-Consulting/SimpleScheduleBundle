<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use IDCI\Bundle\SimpleScheduleBundle\Entity\Recur;

class RecurChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('frequency', 'choice', array(
                'choices'  => Recur::getFrequencies(),
            ))
        ;
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_recurchoicestype';
    }
}
