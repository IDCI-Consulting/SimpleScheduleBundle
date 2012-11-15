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
 * This entity is based on the VEVENT Component from the RFC2445
 *
 * Purpose: Provide a grouping of component properties that describe an event.
 *
 * @ORM\Table(name="idci_schedule_event")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\EventRepository")
 */
class Event
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
     * geo
     */
    protected $geo;

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
     * @ORM\Column(type="integer")
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
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="eventss", cascade={"persist"})
     * @ORM\JoinTable(name="event_category",
     *    joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
     protected $categories

    /**
     * comment
     */
     protected $comments

    /**
     * contact
     */
     protected $contacts

    /**
     * exdate
     */
     protected $exdates

    /**
     * exrule
     */
     protected $exrules

    /**
     * rstatus
     */
     protected $rstatutes

    /**
     * related
     */
     protected $relateds

    /**
     * resources
     */
     protected $resources

    /**
     * rdate
     */
     protected $rdates

    /**
     * rrule
     */
     protected $rrules

    /**
     * x-prop
     */
     protected $xprops

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
