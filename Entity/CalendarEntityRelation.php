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
 * This entity is based on the "VEVENT", "VTODO", "VJOURNAL" Component from the RFC2445
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\CalendarEntityRelationRepository")
 * @ORM\Table(name="idci_schedule_entity_relation")
 */
class CalendarEntityRelation
{
    const RELATION_TYPE_PARENT  = "PARENT";
    const RELATION_TYPE_CHILD   = "CHILD";
    const RELATION_TYPE_SIBLING = "SIBLING";

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * entity
     *
     * @ORM\ManyToOne(targetEntity="CalendarEntity", inversedBy="relateds")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $calendarEntity;

    /**
     * relatedTo
     *
     * @ORM\ManyToOne(targetEntity="CalendarEntity", inversedBy="calendarEntities")
     * @ORM\JoinColumn(name="related_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $relatedTo;

    /**
     * reltype
     *
     * reltypeparam       = "RELTYPE" "="
     *                    "PARENT"      ; Parent relationship. Default.
     *                    "CHILD"       ; Child relationship
     *                    "SIBLING      ; Sibling relationship
     *                    iana-token    ; Some other IANA registered iCalendar relationship type
     *                    x-name)       ; A non-standard, experimental relationship type
     *
     * @ORM\Column(type="string", length=64, nullable=true, name="relation_type")
     * @Assert\Choice(choices = {"PARENT","CHILD","SIBLING"}, message = "Choose a valid relation type.")
     */
    protected $relationType;

    /**
     * getRelationTypes
     */
    public static function getRelationTypes()
    {
        return array(
            self::RELATION_TYPE_PARENT  => self::RELATION_TYPE_PARENT,
            self::RELATION_TYPE_CHILD   => self::RELATION_TYPE_CHILD,
            self::RELATION_TYPE_SIBLING => self::RELATION_TYPE_SIBLING
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
     * Set relationType
     *
     * @param string $relationType
     * @return CalendarEntityRelation
     */
    public function setRelationType($relationType)
    {
        $this->relationType = $relationType;
    
        return $this;
    }

    /**
     * Get relationType
     *
     * @return string 
     */
    public function getRelationType()
    {
        return $this->relationType;
    }

    /**
     * Set calendarEntity
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntity
     * @return CalendarEntityRelation
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

    /**
     * Set relatedTo
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $relatedTo
     * @return CalendarEntityRelation
     */
    public function setRelatedTo(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $relatedTo = null)
    {
        $this->relatedTo = $relatedTo;
    
        return $this;
    }

    /**
     * Get relatedTo
     *
     * @return \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity 
     */
    public function getRelatedTo()
    {
        return $this->relatedTo;
    }
}
