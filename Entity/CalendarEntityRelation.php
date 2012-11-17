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
 * This entity is based on the "VEVENT", "VTODO", "VJOURNAL" Component from the RFC2445
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\CalendarEntityRelationRepository")
 * @ORM\Table(name="idci_schedule_entity_relation")
 */
class CalendarEntityRelation
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
     * @ORM\ManyToOne(targetEntity="CalendarEntity", inversedBy="entities")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     */
    protected $entity;

    /**
     * relatedTo
     *
     * @ORM\ManyToOne(targetEntity="CalendarEntity", inversedBy="relateds")
     * @ORM\JoinColumn(name="related_id", referencedColumnName="id")
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
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\Choice(choices = {"PARENT","CHILD","SIBLING"}, message = "Choose a valid relation type.")
     */
    protected $reltype;
}
