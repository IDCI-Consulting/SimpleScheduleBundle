<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class RecurType extends AbstractType
{
    abstract public function buildSpecificRecurForm(FormBuilderInterface $builder, array $options);

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildSpecificRecurForm($builder, $options);

        $builder
            ->add('frequency', 'hidden')
            ->add('rinterval', 'integer', array(
                'label'    => 'Repeat each',
                'required' => false
            ))
            ->add('over', 'choice', array(
                'choices'       => array(
                    sprintf('%s_%s', $this->getName(), 'never')  => 'never',
                    sprintf('%s_%s', $this->getName(), 'rcount') => 'count',
                    sprintf('%s_%s', $this->getName(), 'until')  => 'until'
                ),
                'multiple'      => false,
                'expanded'      => true,
                'property_path' => false,
                'attr'          => array('class' => 'over_selection'),
                'data'          => sprintf('%s_%s', $this->getName(), 'never')
            ))
            ->add('rcount', 'integer', array(
                'label'    => 'Count occurence',
                'required' => false
            ))
            ->add('until')
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
