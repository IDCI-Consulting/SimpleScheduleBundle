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
 * @ORM\Table(name="idci_schedule_location")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\LocationRepository")
 */
class Location
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
     * @ORM\Column(type="decimal", precision=10, scale=6, nullable=true)
     * @Assert\Max(limit = 90, message = "You must be between -90 and 90.")
     * @Assert\Min(limit = "-90", message = "You must be between -90 and 90.")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6, nullable=true)
     * @Assert\Max(limit = 180, message = "You must be between -180 and 180.")
     * @Assert\Min(limit = "-180", message = "You must be between -180 and 180.")
     */
    protected $longitude;

    /**
     * @ORM\OneToMany(targetEntity="CalendarEntity", mappedBy="location")
     */
    protected $calendarEntities;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

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
     * getGeo
     *
     * @return string
     */
    public function getGeo()
    {
        return sprintf('%.6f;%.6f', $this->getLatitude(), $this->getLongitude());
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
     * @return Location
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
     * @return Location
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
     * Set latitude
     *
     * @param float $latitude
     * @return Location
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Location
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Add locationAwareCalendarEntities
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\LocationAwareCalendarEntity $locationAwareCalendarEntities
     * @return Location
     */
    public function addLocationAwareCalendarEntitie(\IDCI\Bundle\SimpleScheduleBundle\Entity\LocationAwareCalendarEntity $locationAwareCalendarEntities)
    {
        $this->locationAwareCalendarEntities[] = $locationAwareCalendarEntities;
    
        return $this;
    }

    /**
     * Remove locationAwareCalendarEntities
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\LocationAwareCalendarEntity $locationAwareCalendarEntities
     */
    public function removeLocationAwareCalendarEntitie(\IDCI\Bundle\SimpleScheduleBundle\Entity\LocationAwareCalendarEntity $locationAwareCalendarEntities)
    {
        $this->locationAwareCalendarEntities->removeElement($locationAwareCalendarEntities);
    }

    /**
     * Get locationAwareCalendarEntities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocationAwareCalendarEntities()
    {
        return $this->locationAwareCalendarEntities;
    }
}
