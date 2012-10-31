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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="idci_schedule_task")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $day;

    /**
     * @ORM\Column(type="time")
     * @Assert\Time()
     */
    protected $starts_on;

    /**
     * @ORM\Column(type="time")
     * @Assert\Time()
     */
    protected $ends_on;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\Activity")
     * @ORM\JoinColumn(name="activity_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $activity;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $location;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%d] %s - %s",
            $this->getId(),
            $this->getLocation(),
            $this->getActivity()
        );
    }

    /**
     * Count unit
     *
     * @param integer step (in minutes)
     * @return integer the number of step equal to the task duration
     */ 
    public function countUnit($step)
    {
        $duration = $this->getEndsOn() - $this->getStartsOn();

        return ceil($duration / 60 / $step);
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
     * Set day
     *
     * @param integer $day
     * @return Task
     */
    public function setDay($day)
    {
        $this->day = $day;
    
        return $this;
    }

    /**
     * Get day
     *
     * @return integer 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set starts_on
     *
     * @param \DateTime $startsOn
     * @return Task
     */
    public function setStartsOn($startsOn)
    {
        $this->starts_on = $startsOn;
    
        return $this;
    }

    /**
     * Get starts_on
     *
     * @return \DateTime 
     */
    public function getStartsOn()
    {
        return $this->starts_on;
    }

    /**
     * Set ends_on
     *
     * @param \DateTime $endsOn
     * @return Task
     */
    public function setEndsOn($endsOn)
    {
        $this->ends_on = $endsOn;
    
        return $this;
    }

    /**
     * Get ends_on
     *
     * @return \DateTime 
     */
    public function getEndsOn()
    {
        return $this->ends_on;
    }

    /**
     * Set activity
     *
     * @param IDCI\Bundle\SimpleScheduleBundle\Entity\Activity $activity
     * @return Task
     */
    public function setActivity(\IDCI\Bundle\SimpleScheduleBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;
    
        return $this;
    }

    /**
     * Get activity
     *
     * @return IDCI\Bundle\SimpleScheduleBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set location
     *
     * @param IDCI\Bundle\SimpleScheduleBundle\Entity\Location $location
     * @return Task
     */
    public function setLocation(\IDCI\Bundle\SimpleScheduleBundle\Entity\Location $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return IDCI\Bundle\SimpleScheduleBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }
}
