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

    public function getTemplate()
    {
        return $this->container->get('templating');
    }

    /**
     * getAll
     *
     * @return DoctrineCollection
     */
    public function getAll()
    {
        $entities = $this
            ->getEntityManager()
            ->getRepository('IDCISimpleScheduleBundle:CalendarEntity')
            ->getAllOrderByStartAt()
        ;

        return $entities;
    }

    /**
     * query
     *
     * @param array Parameters
     * @return DoctrineCollection
     */
    public function query($params)
    {
        $entities = $this
            ->getEntityManager()
            ->getRepository('IDCISimpleScheduleBundle:CalendarEntity')
            ->query($params)
        ;

        return $entities;
    }
}

