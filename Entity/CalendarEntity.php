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
 * This entity is based on the "VEVENT", "VTODO", "VJOURNAL" components
 * describe in the RFC2445
 *
 * Purpose: Provide a grouping of component properties that describe 
 * a schedulable element.
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\CalendarEntityRepository")
 * @ORM\Table(name="idci_schedule_entity")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"event"="Event", "todo"="Todo", "journal"="Journal"})
 */
class CalendarEntity
{
    const CLASSIFICATION_PUBLIC        = "PUBLIC";
    const CLASSIFICATION_PRIVATE       = "PRIVATE";
    const CLASSIFICATION_CONFIDENTIAL  = "CONFIDENTIAL";

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * created
     *
     * This property specifies the date and time that the calendar
     * information was created by the calendar user agent in the calendar
     * store.
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * dtstart
     *
     * This property specifies when the calendar component begins.
     *
     * @ORM\Column(type="datetime", name="start_at")
     */
    protected $startAt;

    /**
     * last-mod
     *
     * The property specifies the date and time that the
     * information associated with the calendar component was last revised
     * in the calendar store.
     *
     * @ORM\Column(type="datetime", name="last_modified_at")
     */
    protected $lastModifiedAt;

    /**
     * summary
     *
     * This property defines a short summary or subject for the
     * calendar component.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $summary;

    /**
     * description
     *
     * This property provides a more complete description of the
     * calendar component, than that provided by the "SUMMARY" property.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * comment
     *
     * This property specifies non-processing information intended
     * to provide a comment to the calendar user.
     *
     * @ORM\Column(type="string", length=255)
     */
     protected $comment;

    /**
     * url
     *
     * This property defines a Uniform Resource Locator (URL)
     * associated with the iCalendar object.
     *
     * @ORM\Column(type="string", length=255)
     */
     protected $url;

    /**
     * organizer
     *
     * Purpose: The property defines the organizer for a calendar component.
     *
     * The following is an example of this property:
     * ORGANIZER;CN=John Smith:MAILTO:jsmith@host1.com
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $organizer;

    /**
     * seq
     *
     * This property defines the revision sequence number of the
     * calendar component within a sequence of revisions.
     *
     * Description: When a calendar component is created, its sequence
     * number is zero (US-ASCII decimal 48). It is monotonically incremented
     * by the "Organizer's" CUA each time the "Organizer" makes a
     * significant revision to the calendar component. When the "Organizer"
     * makes changes to one of the following properties, the sequence number
     * MUST be incremented:
     * .  "DTSTART"
     * .  "DTEND"
     * .  "DUE"
     * .  "RDATE"
     * .  "RRULE"
     * .  "EXDATE"
     * .  "EXRULE"
     * .  "STATUS"
     *
     * @ORM\Column(type="integer", name="revision_sequence")
     */
    protected $revisionSequence = 0;

    /**
     * attendee
     *
     * The property defines an "Attendee" within a calendar
     * component.
     *
     * attendee   = "ATTENDEE" attparam ":" cal-address CRLF
     * attparam   = *(
     *           ; the following are optional,
     *           ; but MUST NOT occur more than once
     *           (";" cutypeparam) / (";"memberparam) /
     *           (";" roleparam) / (";" partstatparam) /
     *           (";" rsvpparam) / (";" deltoparam) /
     *           (";" delfromparam) / (";" sentbyparam) /
     *           (";"cnparam) / (";" dirparam) /
     *           (";" languageparam) /
     *           ; the following is optional,
     *           ; and MAY occur more than once
     *           (";" xparam)
     *           )
     *
     * The following are examples of this property's use for a to-do:
     *
     * ATTENDEE;MEMBER="MAILTO:DEV-GROUP@host2.com":
     *  MAILTO:joecool@host2.com
     * ATTENDEE;DELEGATED-FROM="MAILTO:immud@host3.com":
     *  MAILTO:ildoit@host1.com
     *
     * The following is an example of this property used for specifying
     * multiple attendees to an event:
     *
     * ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=TENTATIVE;CN=Henry Cabot
     *  :MAILTO:hcabot@host2.com
     * ATTENDEE;ROLE=REQ-PARTICIPANT;DELEGATED-FROM="MAILTO:bob@host.com"
     *  ;PARTSTAT=ACCEPTED;CN=Jane Doe:MAILTO:jdoe@host1.com
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
     protected $attendees;

    /**
     * contact
     *
     * The property is used to represent contact information or
     * alternately a reference to contact information associated with the
     * calendar component.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
     protected $contacts;

    /**
     * exdate
     *
     * This property defines the list of date/time exceptions for a
     * recurring calendar component.
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="excluded_dates")
     */
     protected $excludedDates;

    /**
     * rdate
     *
     * This property defines the list of date/times for a
     * recurrence set.
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="included_dates")
     */
     protected $includedDates;

    /**
     * x-prop
     *
     * Any property name with a "X-" prefix
     *
     * This class of property provides a framework for defining
     * non-standard properties.
     *
     * @ORM\Column(type="text", nullable=true, name="x_prop")
     */
     protected $xProp;

    /**
     * class
     *
     * This property defines the access classification for a calendar component.
     *
     * class      = "CLASS" classparam ":" classvalue CRLF
     * classparam = *(";" xparam)
     * classvalue = "PUBLIC" / "PRIVATE" / "CONFIDENTIAL" / iana-token / x-name
     * Default is PUBLIC
     *
     * @ORM\Column(type="string", length=32)
     * @Assert\Choice(choices = {"PUBLIC","PRIVATE","CONFIDENTIAL"}, message = "Choose a valid access classification.")
     */
    protected $classification = self::CLASSIFICATION_PUBLIC;

    /**
     * @ORM\OneToMany(targetEntity="CalendarEntityRelation", mappedBy="entity")
     */
    protected $entities;

    /**
     * related
     * 
     * The property is used to represent a relationship or
     * reference between one calendar component and another.
     *
     * @ORM\OneToMany(targetEntity="CalendarEntityRelation", mappedBy="relatedTo")
     */
    protected $relateds;

    /**
     * status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="calendarEntities")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="Set null")
     */
    protected $status;

    /**
     * categories
     *
     * This property defines the categories for a calendar component.
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="calendarEntities", cascade={"persist"})
     * @ORM\JoinTable(name="idci_schedule_entity_category",
     *     joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="Cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="Cascade")}
     * )
     */
     protected $categories;

    /**
     * rrule
     *
     * @ORM\ManyToMany(targetEntity="Recur", inversedBy="includedEntities", cascade={"persist"})
     * @ORM\JoinTable(name="idci_schedule_entity_include_rule",
     *     joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="Cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="recur_id", referencedColumnName="id", onDelete="Cascade")}
     * )
     */
     protected $includedRules;

    /**
     * exrule
     *
     * @ORM\ManyToMany(targetEntity="Recur", inversedBy="excludedEntities", cascade={"persist"})
     * @ORM\JoinTable(name="idci_schedule_entity_exclude_rule",
     *     joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="Cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="recur_id", referencedColumnName="id", onDelete="Cascade")}
     * )
     */
     protected $excludedRules;

// To keep recurid attachs ?

    /**
     * recurid
     *
     * The "RECURRENCE-ID" property is used in conjunction with the "UID"
     * and "SEQUENCE" property to identify a particular instance of a
     * recurring event, to-do or journal. For a given pair of "UID" and
     * "SEQUENCE" property values, the "RECURRENCE-ID" value for a
     * recurrence instance is fixed. When the definition of the recurrence
     * set for a calendar component changes, and hence the "SEQUENCE"
     * property value changes, the "RECURRENCE-ID" for a given recurrence
     * instance might also change.The "RANGE" parameter is used to specify
     * the effective range of recurrence instances from the instance
     * specified by the "RECURRENCE-ID" property value. The default value
     * for the range parameter is the single recurrence instance only. The
     * value can also be "THISANDPRIOR" to indicate a range defined by the
     * given recurrence instance and all prior instances or the value can be
     * "THISANDFUTURE" to indicate a range defined by the given recurrence
     * instance and all subsequent instances.
     *
     * The following are examples of this property:
     *  RECURRENCE-ID;VALUE=DATE:19960401
     *  RECURRENCE-ID;RANGE=THISANDFUTURE:19960120T120000Z
     *
     */
    protected $recurid;

    /**
     * attach
     *
     * The property provides the capability to associate a document
     * object with a calendar component.
     */
    protected $attachs;

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
        return sprintf("%d] %s - %s",
            $this->getId(),
            $this->getLocation(),
            $this->getActivity()
        );
    }

    /**
     * uid
     *
     * This property defines the persistent, globally unique
     * identifier for the calendar component.
     * Description: The UID itself MUST be a globally unique identifier. The
     * generator of the identifier MUST guarantee that the identifier is
     * unique. There are several algorithms that can be used to accomplish
     * this. The identifier is RECOMMENDED to be the identical syntax to the
     * [RFC 822] addr-spec. A good method to assure uniqueness is to put the
     * domain name or a domain literal IP address of the host on which the
     * identifier was created on the right hand side of the "@", and on the
     * left hand side, put a combination of the current calendar date and
     * time of day (i.e., formatted in as a DATE-TIME value) along with some
     * other currently unique (perhaps sequential) identifier available on
     * the system (for example, a process id number). Using a date/time
     * value on the left hand side and a domain name or domain literal on
     * the right hand side makes it possible to guarantee uniqueness since
     * no two hosts should be using the same domain name or IP address at
     * the same time. Though other algorithms will work, it is RECOMMENDED
     * that the right hand side contain some domain identifier (either of
     * the host itself or otherwise) such that the generator of the message
     * identifier can guarantee the uniqueness of the left hand side within
     * the scope of that domain.
     *
     * @param string The server domain name or ip address
     * @return string A unique UID
     */
    public function getUID($domain = 'default')
    {
        return sprintf('%s-%d@%s',
            $this->getFormatedStartAt(),
            $this->getId(),
            $domain
        );
    }

    /**
     * getFormatedStartAt
     *
     * @param string The datetime format
     * @param string The timezone name
     * @return string The formated datetime
     */
    public function getFormatedStartAt($format = \DateTime::RFC1123, $timezone = 'Europe/Paris')
    {
        $dt = $this->getStartAt();
        $dt->setTimeZone(new \DateTimezone($timezone));

        return $dt->format($format);
    }
}