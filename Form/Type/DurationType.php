<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\SimpleScheduleBundle\Form\DataTransformer\DurationToStringTransformer;

class DurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('week', 'choice', array(
                'choices' => range(0, 52)
            ))
            ->add('day', 'choice', array(
                'choices' => range(0, 6)
            ))
            ->add('hour', 'choice', array(
                'choices' => range(0, 23)
            ))
            ->add('minute', 'choice', array(
                'choices' => range(0, 59)
            ))
            ->add('second', 'choice', array(
                'choices' => range(0, 59)
            ))
        ;

        $transformer = new DurationToStringTransformer();
        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        //$resolver->setDefaults();
    }

    public function getParent()
    {
        return 'field';
    }

    public function getName()
    {
        return 'duration';
    }
}
