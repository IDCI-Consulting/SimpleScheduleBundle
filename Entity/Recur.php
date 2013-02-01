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
 * This entity is based on the Recur value from the RFC2445
 *
 * Purpose: This value type is used to identify properties that contain a recurrence rule specification.
 *
 * @ORM\Table(name="idci_schedule_recur")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\RecurRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recur
{
    const FREQ_SECONDLY = "SECONDLY";
    const FREQ_MINUTELY = "MINUTELY";
    const FREQ_HOURLY   = "HOURLY";
    const FREQ_DAILY    = "DAILY";
    const FREQ_WEEKLY   = "WEEKLY";
    const FREQ_MONTHLY  = "MONTHLY";
    const FREQ_YEARLY   = "YEARLY";

    const WEEKDAY_SUNDAY    = "SU";
    const WEEKDAY_MONDAY    = "MO";
    const WEEKDAY_TUESDAY   = "TU";
    const WEEKDAY_WEDNESDAY = "WE";
    const WEEKDAY_THURSDAY  = "TH";
    const WEEKDAY_FRIDAY    = "FR";
    const WEEKDAY_SATURDAY  = "SA";

    const MONTH_JANUARY    = 1;
    const MONTH_FEBRUARY   = 2;
    const MONTH_MARCH      = 3;
    const MONTH_APRIL      = 4;
    const MONTH_MAY        = 5;
    const MONTH_JUN        = 6;
    const MONTH_JULY       = 7;
    const MONTH_AUGUST     = 8;
    const MONTH_SEPTEMBER  = 9;
    const MONTH_OCTOBER    = 10;
    const MONTH_NOVEMBER   = 11;
    const MONTH_DECEMBER   = 12;

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
    protected $frequency;

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
    protected $rcount;

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
    protected $rinterval;

    /**
     * over
     */
     protected $over;

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
     * includedEntity
     *
     * @ORM\OneToOne(targetEntity="CalendarEntity", inversedBy="includedRule", orphanRemoval=true)
     * @ORM\JoinColumn(name="included_entity_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $includedEntity;

    /**
     * excludedEntity
     *
     * @ORM\OneToOne(targetEntity="CalendarEntity", inversedBy="excludedRule", orphanRemoval=true)
     * @ORM\JoinColumn(name="excluded_entity_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $excludedEntity;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->__toArray());
    }

    /**
     * toArray
     *
     * @return array
     */
    public function __toArray()
    {
        return array($this->getFrequency() => $this->getBys());
    }

    /**
     * getBys
     *
     * @return array
     */
    public function getBys()
    {
        $bys = array();
        if($this->getBySecond()) {
            $bys['second'] = $this->getBySecond();
        }
        if($this->getByMinute()) {
            $bys['minute'] = $this->getByMinute();
        }
        if($this->getByHour()) {
            $bys['hour'] = $this->getByHour();
        }
        if($this->getByDay()) {
            $bys['day'] = $this->getByDay();
        }
        if($this->getByMonthday()) {
            $bys['monthday'] = $this->getByMonthday();
        }
        if($this->getByYearday()) {
            $bys['yearday'] = $this->getByYearday();
        }
        if($this->getByWeekno()) {
            $bys['weekno'] = $this->getByWeekno();
        }
        if($this->getByMonth()) {
            $bys['month'] = $this->getByMonth();
        }
        if($this->getUntil()) {
            $bys['until'] = array($this->getUntil()->format('Y-m-d H:i'));
        }
        if($this->getRcount()) {
            $bys['count'] = array($this->getRcount());
        }
        if($this->getRinterval()) {
            $bys['interval'] = array($this->getRinterval());
        }

        return $bys;
    }

    /**
     * getFrequencies
     *
     * @return array()
     */
    public static function getFrequencies()
    {
        return array(
            self::FREQ_SECONDLY  => self::FREQ_SECONDLY,
            self::FREQ_MINUTELY  => self::FREQ_MINUTELY,
            self::FREQ_HOURLY    => self::FREQ_HOURLY,
            self::FREQ_DAILY     => self::FREQ_DAILY,
            self::FREQ_WEEKLY    => self::FREQ_WEEKLY,
            self::FREQ_MONTHLY   => self::FREQ_MONTHLY,
            self::FREQ_YEARLY    => self::FREQ_YEARLY
        );
    }

    /**
     * getYearDays
     *
     * @return array()
     */
    public static function getYearDay()
    {
        return array_combine(range(1, 365), range(1, 365));
    }

    /**
     * getYearDays
     *
     * @return array()
     */
    public static function getMonth()
    {
        return array(
            self::MONTH_JANUARY    => "JANUARY",
            self::MONTH_FEBRUARY   => "FEBRUARY",
            self::MONTH_MARCH      => "MARCH",
            self::MONTH_APRIL      => "APRIL",
            self::MONTH_MAY        => "MAY",
            self::MONTH_JUN        => "JUN",
            self::MONTH_JULY       => "JULY",
            self::MONTH_AUGUST     => "AUGUST",
            self::MONTH_SEPTEMBER  => "SEPTEMBER",
            self::MONTH_OCTOBER    => "OCTOBER",
            self::MONTH_NOVEMBER   => "NOVEMBER",
            self::MONTH_DECEMBER   => "DECEMBER",
        );
    }

    /**
     * getMonthDays
     *
     * @return array()
     */
    public static function getMonthDay()
    {
        return array_combine(range(1, 31), range(1, 31));
    }

    /**
     * getWeekDays
     *
     * @return array()
     */
    public static function getWeekDay()
    {
        return array(
            self::WEEKDAY_SUNDAY    => "SUNDAY",
            self::WEEKDAY_MONDAY    => "MONDAY",
            self::WEEKDAY_TUESDAY   => "TUESDAY",
            self::WEEKDAY_WEDNESDAY => "WEDNESDAY",
            self::WEEKDAY_THURSDAY  => "THURSDAY",
            self::WEEKDAY_FRIDAY    => "FRIDAY",
            self::WEEKDAY_SATURDAY  => "SATURDAY"
        );
    }

    /**
     * getHour
     *
     * @return array()
     */
    public static function getHour()
    {
        return range(0, 23);
    }

    /**
     * getMinute
     *
     * @return array()
     */
    public static function getMinute()
    {
        return range(0, 59);
    }

    /**
     * getSecond
     *
     * @return array()
     */
    public static function getSecond()
    {
        return range(0, 59);
    }

    /**
     * overChoice
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function onOverChoice()
    {
        if($this->getOver() != 'rcount') {
            $this->setRcount(null);
        }
        if($this->getOver() != 'until') {
            $this->setUntil(null);
        }
    }

    /**
     * Set over
     *
     * @param string $over
     * @return Recur
     */
    public function setOver($over)
    {
        $this->over = $over;
    
        return $this;
    }

    /**
     * Get over
     *
     * @return string 
     */
    public function getOver()
    {
        return $this->over;
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
     * Set frequency
     *
     * @param string $frequency
     * @return Recur
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    
        return $this;
    }

    /**
     * Get frequency
     *
     * @return string 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set until
     *
     * @param \DateTime $until
     * @return Recur
     */
    public function setUntil($until)
    {
        $this->until = $until;
    
        return $this;
    }

    /**
     * Get until
     *
     * @return \DateTime 
     */
    public function getUntil()
    {
        return $this->until;
    }

    /**
     * Set rcount
     *
     * @param integer $rcount
     * @return Recur
     */
    public function setRcount($rcount)
    {
        $this->rcount = $rcount;
    
        return $this;
    }

    /**
     * Get rcount
     *
     * @return integer 
     */
    public function getRcount()
    {
        return $this->rcount;
    }

    /**
     * Set rinterval
     *
     * @param integer $rinterval
     * @return Recur
     */
    public function setRinterval($rinterval)
    {
        $this->rinterval = $rinterval;
    
        return $this;
    }

    /**
     * Get rinterval
     *
     * @return integer 
     */
    public function getRinterval()
    {
        return $this->rinterval;
    }

    /**
     * Set bySecond
     *
     * @param string $bySecond
     * @return Recur
     */
    public function setBySecond($bySecond)
    {
        $this->bySecond = json_encode($bySecond, true);
    
        return $this;
    }

    /**
     * Get bySecond
     *
     * @return array 
     */
    public function getBySecond()
    {
        return json_decode($this->bySecond);
    }

    /**
     * Set byMinute
     *
     * @param string $byMinute
     * @return Recur
     */
    public function setByMinute($byMinute)
    {
        $this->byMinute = json_encode($byMinute, true);
    
        return $this;
    }

    /**
     * Get byMinute
     *
     * @return array 
     */
    public function getByMinute()
    {
        return json_decode($this->byMinute);
    }

    /**
     * Set byHour
     *
     * @param string $byHour
     * @return Recur
     */
    public function setByHour($byHour)
    {
        $this->byHour = json_encode($byHour, true);
    
        return $this;
    }

    /**
     * Get byHour
     *
     * @return array 
     */
    public function getByHour()
    {
        return json_decode($this->byHour);
    }

    /**
     * Set byDay
     *
     * @param string $byDay
     * @return Recur
     */
    public function setByDay($byDay)
    {
        $this->byDay = json_encode($byDay, true);
    
        return $this;
    }

    /**
     * Get byDay
     *
     * @return array 
     */
    public function getByDay()
    {
        return json_decode($this->byDay);
    }

    /**
     * Set byMonthday
     *
     * @param string $byMonthday
     * @return Recur
     */
    public function setByMonthday($byMonthday)
    {
        $this->byMonthday = json_encode($byMonthday, true);
    
        return $this;
    }

    /**
     * Get byMonthday
     *
     * @return array 
     */
    public function getByMonthday()
    {
        return json_decode($this->byMonthday);
    }

    /**
     * Set byYearday
     *
     * @param string $byYearday
     * @return Recur
     */
    public function setByYearday($byYearday)
    {
        $this->byYearday = json_encode($byYearday, true);
    
        return $this;
    }

    /**
     * Get byYearday
     *
     * @return array 
     */
    public function getByYearday()
    {
        return json_decode($this->byYearday);
    }

    /**
     * Set byWeekno
     *
     * @param string $byWeekno
     * @return Recur
     */
    public function setByWeekno($byWeekno)
    {
        $this->byWeekno = json_encode($byWeekno, true);
    
        return $this;
    }

    /**
     * Get byWeekno
     *
     * @return array 
     */
    public function getByWeekno()
    {
        return json_decode($this->byWeekno);
    }

    /**
     * Set byMonth
     *
     * @param string $byMonth
     * @return Recur
     */
    public function setByMonth($byMonth)
    {
        $this->byMonth = json_encode($byMonth, true);
    
        return $this;
    }

    /**
     * Get byMonth
     *
     * @return array 
     */
    public function getByMonth()
    {
        return json_decode($this->byMonth);
    }

    /**
     * Set bySetpos
     *
     * @param string $bySetpos
     * @return Recur
     */
    public function setBySetpos($bySetpos)
    {
        $this->bySetpos = json_encode($bySetpos, true);
    
        return $this;
    }

    /**
     * Get bySetpos
     *
     * @return array 
     */
    public function getBySetpos()
    {
        return json_decode($this->bySetpos);
    }

    /**
     * Set wkst
     *
     * @param string $wkst
     * @return Recur
     */
    public function setWkst($wkst)
    {
        $this->wkst = json_encode($wkst, true);
    
        return $this;
    }

    /**
     * Get wkst
     *
     * @return array 
     */
    public function getWkst()
    {
        return json_decode($this->wkst);
    }

    /**
     * Set includedEntity
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $includedEntity
     * @return Recur
     */
    public function setIncludedEntity(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $includedEntity = null)
    {
        $this->includedEntity = $includedEntity;
    
        return $this;
    }

    /**
     * Get includedEntity
     *
     * @return \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity 
     */
    public function getIncludedEntity()
    {
        return $this->includedEntity;
    }

    /**
     * Set excludedEntity
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $excludedEntity
     * @return Recur
     */
    public function setExcludedEntity(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $excludedEntity = null)
    {
        $this->excludedEntity = $excludedEntity;
    
        return $this;
    }

    /**
     * Get excludedEntity
     *
     * @return \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity 
     */
    public function getExcludedEntity()
    {
        return $this->excludedEntity;
    }
}
