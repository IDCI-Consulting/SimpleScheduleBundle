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
 * This entity is based on the Recur value from the RFC2445
 *
 * Purpose: This value type is used to identify properties that contain a recurrence rule specification.
 *
 * @ORM\Table(name="idci_schedule_recur")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\RecurRepository")
 */
class Recur
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * freq (freq)
     * The FREQ rule part identifies the type of recurrence rule. This rule
     * part MUST be specified in the recurrence rule. Valid values include
     * SECONDLY, to specify repeating events based on an interval of a
     * second or more; MINUTELY, to specify repeating events based on an
     * interval of a minute or more; HOURLY, to specify repeating events
     * based on an interval of an hour or more; DAILY, to specify repeating
     * events based on an interval of a day or more; WEEKLY, to specify
     * repeating events based on an interval of a week or more; MONTHLY, to
     * specify repeating events based on an interval of a month or more; and
     * YEARLY, to specify repeating events based on an interval of a year or
     * more.
     *
     * freq       = "SECONDLY" / "MINUTELY" / "HOURLY" / "DAILY" / "WEEKLY" / "MONTHLY" / "YEARLY"
     *
     * @ORM\Column(type="string", length=32)
     * @Assert\Choice(choices = {"SECONDLY","MINUTELY","HOURLY","DAILY","WEEKLY","MONTHLY","YEARLY"}, message = "Choose a valid frequency.")
     */
    protected $freq;

    /**
     * until (enddate)
     *
     * The UNTIL rule part defines a date-time value which bounds the
     * recurrence rule in an inclusive manner. If the value specified by
     * UNTIL is synchronized with the specified recurrence, this date or
     * date-time becomes the last instance of the recurrence. If specified
     * as a date-time value, then it MUST be specified in an UTC time
     * format. If not present, and the COUNT rule part is also not present,
     * the RRULE is considered to repeat forever.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $until;

    /**
     * count (1*DIGIT)
     *
     * The COUNT rule part defines the number of occurrences at which to
     * range-bound the recurrence. The "DTSTART" property value, if
     * specified, counts as the first occurrence.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $count;

    /**
     * interval (1*DIGIT)
     *
     * The INTERVAL rule part contains a positive integer representing how
     * often the recurrence rule repeats. The default value is "1", meaning
     * every second for a SECONDLY rule, or every minute for a MINUTELY
     * rule, every hour for an HOURLY rule, every day for a DAILY rule,
     * every week for a WEEKLY rule, every month for a MONTHLY rule and
     * every year for a YEARLY rule.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $interval;

    /**
     * bysecond (byseclist)
     *
     * The BYSECOND rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of seconds within a minute. Valid values are 0 to
     * 59.
     *
     * byseclist  = seconds / ( seconds *("," seconds) )
     * seconds    = 1DIGIT / 2DIGIT       ;0 to 59
     *
     * @ORM\Column(type="string", nullable=true, name="by_second")
     */
    protected $bySecond;

    /**
     * byminute (byminlist)
     *
     * The BYMINUTE rule part specifies a COMMA character (US-ASCII
     * decimal 44) separated list of minutes within an hour. Valid values
     * are 0 to 59.
     *
     * byminlist  = minutes / ( minutes *("," minutes) )
     * minutes    = 1DIGIT / 2DIGIT       ;0 to 59
     *
     * @ORM\Column(type="string", nullable=true, name="by_minute")
     */
    protected $byMinute;

    /**
     * byhour (byhrlist)
     *
     * The BYHOUR rule part specifies a COMMA character (US-
     * ASCII decimal 44) separated list of hours of the day. Valid values
     * are 0 to 23.
     *
     * byhrlist   = hour / ( hour *("," hour) )
     * hour       = 1DIGIT / 2DIGIT       ;0 to 23
     *
     * @ORM\Column(type="string", nullable=true, name="by_hour")
     */
    protected $byHour;

    /**
     * byday (bywdaylist)
     *
     * The BYDAY rule part specifies a COMMA character (US-ASCII decimal 44)
     * separated list of days of the week; MO indicates Monday; TU indicates
     * Tuesday; WE indicates Wednesday; TH indicates Thursday; FR indicates
     * Friday; SA indicates Saturday; SU indicates Sunday.
     *
     * Each BYDAY value can also be preceded by a positive (+n) or negative
     * (-n) integer. If present, this indicates the nth occurrence of the
     * specific day within the MONTHLY or YEARLY RRULE. For example, within
     * a MONTHLY rule, +1MO (or simply 1MO) represents the first Monday
     * within the month, whereas -1MO represents the last Monday of the
     * month. If an integer modifier is not present, it means all days of
     * this type within the specified frequency. For example, within a
     * MONTHLY rule, MO represents all Mondays within the month.
     *
     * bywdaylist = weekdaynum / ( weekdaynum *("," weekdaynum) )
     * weekdaynum = [([plus] ordwk / minus ordwk)] weekday
     * plus       = "+"
     * minus      = "-"
     * ordwk      = 1DIGIT / 2DIGIT       ;1 to 53
     * weekday    = "SU" / "MO" / "TU" / "WE" / "TH" / "FR" / "SA"
     *
     * @ORM\Column(type="string", nullable=true, name="by_day")
     */
    protected $byDay;

    /**
     * bymonthday (bymodaylist)
     *
     * The BYMONTHDAY rule part specifies a COMMA character (ASCII decimal
     * 44) separated list of days of the month. Valid values are 1 to 31 or
     * -31 to -1. For example, -10 represents the tenth to the last day of
     * the month.
     *
     * bymodaylist = monthdaynum / ( monthdaynum *("," monthdaynum) )
     * monthdaynum = ([plus] ordmoday) / (minus ordmoday)
     * ordmoday    = 1DIGIT / 2DIGIT       ;1 to 31
     *
     * @ORM\Column(type="string", nullable=true, name="by_monthday")
     */
    protected $byMonthday;

    /**
     * byyearday (byyrdaylist)
     *
     * The BYYEARDAY rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of days of the year. Valid values are 1 to 366 or
     * -366 to -1. For example, -1 represents the last day of the year
     * (December 31st) and -306 represents the 306th to the last day of the
     * year (March 1st).
     *
     * byyrdaylist = yeardaynum / ( yeardaynum *("," yeardaynum) )
     * yeardaynum = ([plus] ordyrday) / (minus ordyrday)
     * ordyrday   = 1DIGIT / 2DIGIT / 3DIGIT      ;1 to 366
     *
     * @ORM\Column(type="string", nullable=true, name="by_yearday")
     */
    protected $byYearday;

    /**
     * byweekno (bywknolist)
     *
     * The BYWEEKNO rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of ordinals specifying weeks of the year. Valid
     * values are 1 to 53 or -53 to -1. This corresponds to weeks according
     * to week numbering as defined in [ISO 8601]. A week is defined as a
     * seven day period, starting on the day of the week defined to be the
     * week start (see WKST). Week number one of the calendar year is the
     * first week which contains at least four (4) days in that calendar
     * year. This rule part is only valid for YEARLY rules. For example, 3
     * represents the third week of the year.
     *
     * bywknolist = weeknum / ( weeknum *("," weeknum) )
     * weeknum    = ([plus] ordwk) / (minus ordwk)
     *
     * @ORM\Column(type="string", nullable=true, name="by_weekno")
     */
    protected $byWeekno;

    /**
     * bymonth (bymolist)
     *
     * The BYMONTH rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of months of the year. Valid values are 1 to 12.
     *
     * bymolist   = monthnum / ( monthnum *("," monthnum) )
     * monthnum   = 1DIGIT / 2DIGIT       ;1 to 12
     *
     * @ORM\Column(type="string", nullable=true, name="by_month")
     */
    protected $byMonth;

    /**
     * bysetpos (bysplist)
     *
     * The BYSETPOS rule part specifies a COMMA character (US-ASCII decimal
     * 44) separated list of values which corresponds to the nth occurrence
     * within the set of events specified by the rule. Valid values are 1 to
     * 366 or -366 to -1. It MUST only be used in conjunction with another
     * BYxxx rule part. For example "the last work day of the month" could
     * be represented as:
     *
     * RRULE:FREQ=MONTHLY;BYDAY=MO,TU,WE,TH,FR;BYSETPOS=-1
     *
     * Each BYSETPOS value can include a positive (+n) or negative (-n)
     * integer. If present, this indicates the nth occurrence of the
     * specific occurrence within the set of events specified by the rule.
     *
     * bysplist   = setposday / ( setposday *("," setposday) )
     * setposday  = yeardaynum
     *
     * @ORM\Column(type="string", nullable=true, name="by_setpos")
     */
    protected $bySetpos;

    /**
     * wkst (weekday)
     *
     * The WKST rule part specifies the day on which the workweek starts.
     * Valid values are MO, TU, WE, TH, FR, SA and SU. This is significant
     * when a WEEKLY RRULE has an interval greater than 1, and a BYDAY rule
     * part is specified. This is also significant when in a YEARLY RRULE
     * when a BYWEEKNO rule part is specified. The default value is MO.
     *
     * weekday    = "SU" / "MO" / "TU" / "WE" / "TH" / "FR" / "SA"
     *
     * @ORM\Column(type="string", length=2, nullable=true)
     * @Assert\Choice(choices = {"SU","MO","TU","WE","TH","FR","SA"}, message = "Choose a valid weekday.")
     */
    protected $wkst;

    /**
     * @ORM\ManyToMany(targetEntity="CalendarEntity", mappedBy="includedRules", cascade={"persist"})
     */
    private $includedEntities;

    /**
     * @ORM\ManyToMany(targetEntity="CalendarEntity", mappedBy="excludedRules", cascade={"persist"})
     */
    private $excludedEntities;
}
