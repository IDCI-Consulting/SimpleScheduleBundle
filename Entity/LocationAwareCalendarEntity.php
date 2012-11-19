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
 * This entity is based on the "VEVENT", "VTODO", "VJOURNAL" Component 
 * describe in the RFC2445
 *
 * Purpose: Provide a grouping of component properties that describe an 
 * localizable calendar entity.
 *
 * @ORM\Entity
 */
abstract class LocationAwareCalendarEntity extends CalendarEntity
{
    /**
     * priority
     *
     * The property defines the relative priority for a calendar
     * component.
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = "0",
     *      max = "9",
     *      minMessage = "priority must be at least 0",
     *      maxMessage = "priority must be at max 9"
     * )
     */
    protected $priority;

    /**
     * resources
     *
     * This property defines the equipment or resources anticipated
     * for an activity specified by a calendar entity.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resources;

    /**
     * duration
     *
     * The property specifies a positive duration of time.
     *
     * dur-value  = (["+"] / "-") "P" (dur-date / dur-time / dur-week)
     *
     * dur-date   = dur-day [dur-time]
     * dur-time   = "T" (dur-hour / dur-minute / dur-second)
     * dur-week   = 1*DIGIT "W"
     * dur-hour   = 1*DIGIT "H" [dur-minute]
     * dur-minute = 1*DIGIT "M" [dur-second]
     * dur-second = 1*DIGIT "S"
     * dur-day    = 1*DIGIT "D"
     *
     * Description: If the property permits, multiple "duration" values are
     * specified by a COMMA character (US-ASCII decimal 44) separated list
     * of values. The format is expressed as the [ISO 8601] basic format for
     * the duration of time. The format can represent durations in terms of
     * weeks, days, hours, minutes, and seconds.
     * No additional content value encoding (i.e., BACKSLASH character
     * encoding) are defined for this value type.
     *
     * Example: A duration of 15 days, 5 hours and 20 seconds would be: P15DT5H0M20S
     *
     * A duration of 7 weeks would be: P7W
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $duration;

    /**
     * location
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\Location", inversedBy="locationAwareCalendarEntities")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    protected $location;
}
