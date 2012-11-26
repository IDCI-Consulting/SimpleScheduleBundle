<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MetaToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a string (meta) to an array.
     *
     * @param  string $meta
     * @return array
     */
    public function transform($meta)
    {
        if (null === $meta) {
            return array(
                'namespace' => '',
                'key'       => '',
                'value'     => ''
            );
        }

        return json_decode($meta, true);
    }

    /**
     * Transforms an array (meta) to a string.
     *
     * @param  array $meta
     * @return string
     */
    public function reverseTransform($meta)
    {
        return json_encode($meta);
    }
}
