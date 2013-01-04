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
    static public $TIME_UNITS = array(
        'week'    => 604800,
        'day'     => 86400,
        'hour'    => 3600,
        'minute'  => 60,
        'second'  => 1,
    );

    /**
     * priority
     *
     * The property defines the relative priority for a calendar
     * component.
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *     min = "0",
     *     max = "9",
     *     minMessage = "priority must be at least 0",
     *     maxMessage = "priority must be at max 9"
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
     * hasGeo
     * Check if the related location has latitude and longitude parmaters defined
     * 
     * @return bool
     */
    public function hasGeo()
    {
        return $this->getGeoLatitude() && $this->getGeoLongitude();
    }

    /**
     * getGeoLatitude
     * 
     * @return float
     */
    public function getGeoLatitude()
    {
        if ($this->getLocation()) {
            return $this->getLocation()->getLatitude();
        }

        return null;
    }

    /**
     * getGeoLongitude
     * 
     * @return float
     */
    public function getGeoLongitude()
    {
        if ($this->getLocation()) {
            return $this->getLocation()->getLongitude();
        }

        return null;
    }

    /**
     * durationInTime
     * Convert a duration into a countable given time unit
     *
     * @param string duration
     * @param string time unit [week, day, hour, minute, second]
     * @return float
     */
    static public function durationInTime($duration, $time_unit = 'second')
    {
        if(!$duration) {
            return false;
        }

        if(!in_array($time_unit, array_keys(self::$TIME_UNITS))) {
            throw new Exception(sprintf('Wrong given time unit: %s', $time_unit));
        }

        $durationArray = self::durationToArray($duration);
        $durationSeconds = 0;
        foreach($durationArray as $unit => $value) {
            $durationSeconds += $value * self::$TIME_UNITS[$unit];
        }

        return $durationSeconds / self::$TIME_UNITS[$time_unit];
    }

    public static function arrayToDuration($duration_array)
    {
        if( $duration_array["week"] == 0 &&
            $duration_array["day"] == 0 &&
            $duration_array["hour"] == 0 &&
            $duration_array["minute"] == 0 &&
            $duration_array["second"] == 0) {
            return null;
        }

        $time = '';
        $time .= $duration_array['hour'] ? $duration_array['hour'].'H' : '';
        $time .= $duration_array['minute'] ? $duration_array['minute'].'M' : '';
        $time .= $duration_array['second'] ? $duration_array['second'].'S' : '';

        $duration = 'P';
        $duration .= $duration_array['week'] ? $duration_array['week'].'W' : '';
        $duration .= $duration_array['day'] ? $duration_array['day'].'D' : '';
        $duration .= empty($time) ? '' : 'T'.$time;

        return $duration;
    }

    public static function durationToArray($duration)
    {
        $matches = array();

        $pattern = "#^P(?:([0-9]+)W)?(?:([0-9]+)D)?T?(?:([0-9]+)H)?(?:([0-9]+)M)?(?:([0-9]+)S)?$#";
        if(!preg_match($pattern, $duration, $matches)) {
            return null;
        }

        $result = array(
            'week'   => isset($matches[1]) ? $matches[1] : 0,
            'day'    => isset($matches[2]) ? $matches[2] : 0,
            'hour'   => isset($matches[3]) ? $matches[3] : 0,
            'minute' => isset($matches[4]) ? $matches[4] : 0,
            'second' => isset($matches[5]) ? $matches[5] : 0
        );

        return $result;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return LocationAwareCalendarEntity
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set resources
     *
     * @param string $resources
     * @return LocationAwareCalendarEntity
     */
    public function setResources($resources)
    {
        $this->resources = $resources;
    
        return $this;
    }

    /**
     * Get resources
     *
     * @return string 
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return LocationAwareCalendarEntity
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }
}
