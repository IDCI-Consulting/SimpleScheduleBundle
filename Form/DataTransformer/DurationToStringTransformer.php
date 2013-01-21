<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use IDCI\Bundle\SimpleScheduleBundle\Entity\LocationAwareCalendarEntity;

class DurationToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a string (duration) to an array.
     *
     * @param  string $duration
     * @return array
     */
    public function transform($duration)
    {
        if (null === $duration) {
            return array(
                'week'   => 0,
                'day'    => 0,
                'hour'   => 0,
                'minute' => 0,
                'second' => 0,
            );
        }

        return LocationAwareCalendarEntity::durationToArray($duration);
    }

    /**
     * Transforms an array (duration) to a string.
     *
     * @param  array $duration
     * @return string
     */
    public function reverseTransform($duration)
    {
        return LocationAwareCalendarEntity::arrayToDuration($duration);
    }
}
