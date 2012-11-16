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
 * Purpose: Provide a grouping of component properties that describe an schedulable element.
 *
 * @ORM\Table(name="idci_schedule_element")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\SchedulableElementRepository")
 */
class SchedulableElement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * class
     */
    protected $class;

    /**
     * created
     */
    protected $created;

    /**
     * description
     */
    protected $description;

    /**
     * dtstart
     *
     * @ORM\Column(type="datetime")
     * @Assert\Time()
     */
    protected $dtstart;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Range(
     *      min = "0",
     *      max = "90",
     *      minMessage = "latitude must be at least 0",
     *      maxMessage = "latitude must be at max 10"
     * )
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Range(
     *      min = "-180",
     *      max = "180",
     *      minMessage = "longitude must be at least -180",
     *      maxMessage = "longitude must be at max 180"
     * )
     */
    protected $longitude;

    /**
     * last-mod
     */
    protected $last_mod;

    /**
     * location
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="Cascade")
     */
    protected $location;

    /**
     * organizer
     */
    protected $organizer;

    /**
     * priority
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = "0",
     *      max = "10",
     *      minMessage = "Priority must be at least 0",
     *      maxMessage = "Priority must be at max 10"
     * )
     */
    protected $priority;

    /**
     * dtstamp
     */
    protected $dtstamp;

    /**
     * seq
     */
    protected $seq;

    /**
     * status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="elements")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

    /**
     * summary
     */
    protected $summary;

    /**
     * transp
     */
    protected $transp;

    /**
     * uid
     */
    protected $uid;

    /**
     * url
     */
    protected $url;

    /**
     * recurid
     */
    protected $recurid;

    /**
     * Note: either 'dtend' or 'duration' may appear in a 'eventprop',
     * but 'dtend' and 'duration' MUST NOT occur in the same 'eventprop'
     */

    /**
     * dtend
     *
     * @ORM\Column(type="datetime")
     * @Assert\Time()
     */
    protected $dtend;

    /**
     * duration
     *
     * This value type is used to identify properties that contain a
     * duration of time.
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
     * @ORM\Column(type="datetime")
     * @Assert\Time()
     */
    protected $duration;

    /**
     * Note: The following are optional, and MAY occur more than once
     */

    /**
     * attach
     */
    protected $attachs;

    /**
     * attendee
     */
     protected $attendees;

    /**
     * categories
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="elements", cascade={"persist"})
     * @ORM\JoinTable(name="idci_schedule_element_category",
     *    joinColumns={@ORM\JoinColumn(name="schedule_element_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
     protected $categories;

    /**
     * comment
     */
     protected $comments;

    /**
     * contact
     */
     protected $contacts;

    /**
     * exdate
     */
     protected $exdates;

    /**
     * rstatus
     */
     protected $rstatutes;

    /**
     * related
     */
     protected $relateds;

    /**
     * resources
     */
     protected $resources;

    /**
     * rdate
     */
     protected $rdates;

    /**
     * rrule
     *
     * @ORM\ManyToMany(targetEntity="Recur", inversedBy="included_elements", cascade={"persist"})
     * @ORM\JoinTable(name="idci_schedule_element_include_rule",
     *    joinColumns={@ORM\JoinColumn(name="schedule_element_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="recur_id", referencedColumnName="id")}
     * )
     */
     protected $rrules;

    /**
     * exrule
     * @ORM\ManyToMany(targetEntity="Recur", inversedBy="excluded_elements", cascade={"persist"})
     * @ORM\JoinTable(name="idci_schedule_element_eclude_rule",
     *    joinColumns={@ORM\JoinColumn(name="schedule_element_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="recur_id", referencedColumnName="id")}
     * )
     */
     protected $exrules;

    /**
     * x-prop
     */
     protected $xprops;

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
     * geo
     */
    public function getGeo()
    {
        return sprintf('%.6f;%.6f', $this->getLatitude(), $this->getLongitude());
    }

    /**
     * Get start time formated for ical
     *
     * @return string
     */
    public function getStartTimeFormattedForIcal()
    {
        $dt = $this->getStartsAt();
        $dt->setTimeZone(new \DateTimezone('Europe/Paris'));

        return $dt->format(\DateTime::RFC1123);
    }

    /**
     * Get end time formated for ical
     *
     * @return string
     */
    public function getEndTimeFormattedForIcal()
    {
        $dt = $this->getEndsAt();
        $dt->setTimeZone(new \DateTimezone('Europe/Paris'));

        return $dt->format(\DateTime::RFC1123);
    }
}
