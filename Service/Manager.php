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

    public function getExporterManager()
    {
        return $this->container->get('idci_exporter.manager');
    }

    /**
     * query
     *
     * @param array $params
     * @return ExportResult
     */
    public function query($params)
    {
        $params = self::cleanParams($params);

        $entities = $this
            ->getEntityManager()
            ->getRepository(self::getEntity($params))
            ->query($params)
        ;

        return $this->getExporterManager()
            ->export($entities, self::getFormat($params), $params)
        ;
    }

    /**
     * Clean Params
     *
     * @param array $params
     * @return array
     */
    static public function cleanParams($params)
    {
        $clean = array();
        foreach($params as $k => $v) {
            if($v != '') {
                $clean[$k] = $v;
            }
        }

        return $clean;
    }

    /**
     * getEntity
     *
     * @param array $params
     * @return string The Entity
     */
    static public function getEntity($params)
    {
        return sprintf('IDCISimpleScheduleBundle:%s',
            isset($params['entity']) ? $params['entity'] : 'CalendarEntity'
        );
    }

    /**
     * getFormat
     *
     * @param array $params
     * @return string The format
     */
    static function getFormat($params)
    {
        return isset($params['format']) ? $params['format'] : 'xml';
    }
}

