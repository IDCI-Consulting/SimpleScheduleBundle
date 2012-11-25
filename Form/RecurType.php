<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('frequency', 'hidden')
            ->add('until')
            ->add('rcount')
            ->add('rinterval')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\SimpleScheduleBundle\Entity\Recur'
        ));
    }

    public function getName()
    {
        return 'idci_bundle_simpleschedulebundle_recurtype';
    }
}
