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
 * @ORM\Table(name="idci_schedule_xproperty", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idxUnique", columns={"x_namespace", "x_key"})
 * })
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
     * calendarEntity
     *
     * @ORM\ManyToOne(targetEntity="CalendarEntity", inversedBy="xProperties")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $calendarEntity;

    /**
     * @ORM\Column(type="string", length=64, name="x_namespace")
     */
    protected $xNamespace;

    /**
     * @ORM\Column(type="string", length=64, name="x_key")
     */
    protected $xKey;

    /**
     * @ORM\Column(type="text", nullable=true, name="x_value")
     */
    protected $xValue;

    public function __toString()
    {
        return sprintf('[%s] %s: %s',
            $this->getXNamespace(),
            $this->getXKey(),
            $this->getXValue()
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
     * Set xNamespace
     *
     * @param string $xNamespace
     * @return XProperty
     */
    public function setXNamespace($xNamespace)
    {
        $this->xNamespace = $xNamespace;
    
        return $this;
    }

    /**
     * Get xNamespace
     *
     * @return string 
     */
    public function getXNamespace()
    {
        return $this->xNamespace;
    }

    /**
     * Set xKey
     *
     * @param string $xKey
     * @return XProperty
     */
    public function setXKey($xKey)
    {
        $this->xKey = $xKey;
    
        return $this;
    }

    /**
     * Get xKey
     *
     * @return string 
     */
    public function getXKey()
    {
        return $this->xKey;
    }

    /**
     * Set xValue
     *
     * @param string $xValue
     * @return XProperty
     */
    public function setXValue($xValue)
    {
        $this->xValue = $xValue;
    
        return $this;
    }

    /**
     * Get xValue
     *
     * @return string 
     */
    public function getXValue()
    {
        return $this->xValue;
    }

    /**
     * Set calendarEntity
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntity
     * @return XProperty
     */
    public function setCalendarEntity(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntity = null)
    {
        $this->calendarEntity = $calendarEntity;
    
        return $this;
    }

    /**
     * Get calendarEntity
     *
     * @return \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity 
     */
    public function getCalendarEntity()
    {
        return $this->calendarEntity;
    }
}
