<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This entity is based on the Property Named X-Prop of the RFC2445
 *
 * Purpose: This class of property provides a framework for defining non-standard properties
 *
 * @ORM\Table(name="idci_schedule_xprop")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\XPropertyRepository")
 */
class XProperty
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * entity
     *
     * @ORM\ManyToOne(targetEntity="CalendarEntity", inversedBy="xproperties")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $entity;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $namespace;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $key;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $value;

    public function __toString()
    {
        return sprintf('[%s] %s: %s',
            $this->getNamespace(),
            $this->getKey(),
            $this->getValue()
        );
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set namespace
     *
     * @param string $namespace
     * @return XProperty
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    
        return $this;
    }

    /**
     * Get namespace
     *
     * @return string 
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return XProperty
     */
    public function setKey($key)
    {
        $this->key = $key;
    
        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return XProperty
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set entity
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $entity
     * @return XProperty
     */
    public function setEntity(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $entity = null)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
