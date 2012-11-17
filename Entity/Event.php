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
 * @ORM\Entity
 */
class Event extends LocalizableCalendarEntity
{
    public static $TRANSP_OPAQUE = "OPAQUE";
    public static $TRANSP_TRANSPARENT = "TRANSPARENT";

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Assert\Choice(choices = {"OPAQUE","TRANSPARENT"}, message = "Choose a valid mode")
     */
    protected $transp;

    /**
     * dtend
     *
     * This property specifies the date and time that a calendar
     * component ends.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dtend;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transp = self::$TRANSP_OPAQUE;
    }
}
