<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class WeekDaysToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms an array (week_days) to a string.
     *
     * @param  Issue|null $week_days
     * @return string
     */
    public function transform($week_days)
    {
        return $week_days;
    }

    /**
     * Transforms a string (week_days) to an array.
     *
     * @param  string $week_days
     * @return array
     */
    public function reverseTransform($week_days)
    {
        return json_encode($week_days);
    }
}
