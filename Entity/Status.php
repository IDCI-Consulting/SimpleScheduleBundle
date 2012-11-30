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
 * This entity is based on Property Named STATUS of the RFC2445
 *
 * Purpose: This property defines the overall status or confirmation for the calendar component.
 *
 * @ORM\Table(name="idci_schedule_status")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\StatusRepository")
 */
class Status
{
    // Status values for "EVENT"
    const EVENT_CANCELLED    = "CANCELLED";      // Indicates event was cancelled.
    const EVENT_CONFIRMED    = "CONFIRMED";      // Indicates event is definite.
    const EVENT_TENTATIVE    = "TENTATIVE";      // Indicates event is tentative.

    // Status values for "TODO"
    const TODO_CANCELLED     = "CANCELLED";      // Indicates to-do was cancelled.
    const TODO_COMPLETED     = "COMPLETED";      // Indicates to-do completed.
    const TODO_IN_PROCESS    = "IN-PROCESS";     // Indicates to-do in process of
    const TODO_NEEDS_ACTION  = "NEEDS-ACTION";   // Indicates to-do needs action.

    //Status values for "JOURNAL".
    const JOURNAL_CANCELLED  = "CANCELLED";      // Indicates journal is removed.
    const JOURNAL_DRAFT      = "DRAFT";          // Indicates journal is draft.
    const JOURNAL_FINAL      = "FINAL";          // Indicates journal is final.

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $value;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\Choice(choices = {"Event","Todo","Journal"}, message = "Choose a valid CalendarEntity.")
     */
    protected $discr;

    /**
     * @ORM\OneToMany(targetEntity="CalendarEntity", mappedBy="status")
     */
    protected $calendarEntities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->calendarEntities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getValue();
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
     * Set value
     *
     * @param string $value
     * @return Status
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
     * Set discr
     *
     * @param string $discr
     * @return Status
     */
    public function setDiscr($discr)
    {
        $this->discr = $discr;
    
        return $this;
    }

    /**
     * Get discr
     *
     * @return string 
     */
    public function getDiscr()
    {
        return $this->discr;
    }

    /**
     * Add calendarEntities
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities
     * @return Status
     */
    public function addCalendarEntitie(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities)
    {
        $this->calendarEntities[] = $calendarEntities;
    
        return $this;
    }

    /**
     * Remove calendarEntities
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities
     */
    public function removeCalendarEntitie(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities)
    {
        $this->calendarEntities->removeElement($calendarEntities);
    }

    /**
     * Get calendarEntities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalendarEntities()
    {
        return $this->calendarEntities;
    }
}
