<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Service;

class Manager
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getEntityManager()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }

    public function getAll()
    {
        $entities = $this
            ->getEntityManager()
            ->getRepository('IDCISimpleScheduleBundle:CalendarEntity')
            ->findAll()
        ;

        return $entities;
    }
}

