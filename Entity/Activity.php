<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use IDCI\Bundle\SimpleScheduleBundle\Util\StringTools;

/**
 * @ORM\Table(name="idci_schedule_activity")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\ActivityType")
     */
    protected $activity_type;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Slugify
     *
     * @return string
     */
    public function slugify()
    {
        return StringTools::slugify($this->getName());
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
     * Set name
     *
     * @param string $name
     * @return Activity
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Activity
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set activity_type
     *
     * @param IDCI\Bundle\SimpleScheduleBundle\Entity\ActivityType $activityType
     * @return Activity
     */
    public function setActivityType(\IDCI\Bundle\SimpleScheduleBundle\Entity\ActivityType $activityType = null)
    {
        $this->activity_type = $activityType;
    
        return $this;
    }

    /**
     * Get activity_type
     *
     * @return IDCI\Bundle\SimpleScheduleBundle\Entity\ActivityType
     */
    public function getActivityType()
    {
        return $this->activity_type;
    }
}
