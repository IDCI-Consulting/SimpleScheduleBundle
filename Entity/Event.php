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
 * This entity is based on the VEVENT Component describe in the RFC2445
 *
 * Purpose: Provide a grouping of component properties that describe an event.
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\EventRepository")
 */
class Event extends LocationAwareCalendarEntity
{
    const TRANSP_OPAQUE = "OPAQUE";
    const TRANSP_TRANSPARENT = "TRANSPARENT";

    public static $TRANSP = array(self::TRANSP_OPAQUE, self::TRANSP_TRANSPARENT);

    /**
     * transp
     *
     * This property defines whether an event is transparent or not
     * to busy time searches.
     *
     * transp     = "TRANSP" tranparam ":" transvalue CRLF
     * tranparam  = *(";" xparam)
     * transvalue = "OPAQUE"      ;Blocks or opaque on busy time searches.
     *              "TRANSPARENT" ;Transparent on busy time searches.
     *                            ;Default value is OPAQUE
     *
     * @ORM\Column(type="boolean", name="is_transparent")
     */
    protected $isTransparent = false;

    /**
     * dtend
     *
     * This property specifies the date and time that a calendar
     * component ends.
     *
     * @ORM\Column(type="datetime", nullable=true, name="end_at")
     */
    protected $endAt;

    /**
     * Set isTransparent
     *
     * @param boolean $isTransparent
     * @return Event
     */
    public function setIsTransparent($isTransparent)
    {
        $this->isTransparent = $isTransparent;
    
        return $this;
    }

    /**
     * Get isTransparent
     *
     * @return boolean 
     */
    public function getIsTransparent()
    {
        return $this->isTransparent;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Event
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;
    
        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime 
     */
    public function getEndAt()
    {
        return $this->endAt;
    }
}
