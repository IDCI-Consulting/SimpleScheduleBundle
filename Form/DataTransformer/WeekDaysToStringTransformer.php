<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class WeekDaysToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a string (week_days) to an array.
     *
     * @param  string $week_days
     * @return array
     */
    public function transform($week_days)
    {
        if (null === $week_days) {
            return array();
        }

        return json_decode($week_days, true);
    }

    /**
     * Transforms an array (week_days) to a string.
     *
     * @param  array $week_days
     * @return string
     */
    public function reverseTransform($week_days)
    {
        return json_encode($week_days);
    }
}
