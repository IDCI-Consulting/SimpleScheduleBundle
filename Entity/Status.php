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
 * This entity is based on Property Name STATUS of the RFC2445
 *
 * Purpose: This property defines the overall status or confirmation for the calendar component.
 *
 * @ORM\Table(name="idci_schedule_status")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\StatusRepository")
 */
class Status
{
    // Status values for a "VEVENT"
    const VEVENT_TENTATIVE    = "TENTATIVE";      // Indicates event is tentative.
    const VEVENT_CONFIRMED    = "CONFIRMED";      // Indicates event is definite.
    const VEVENT_TENTATIVE    = "CANCELLED";      // Indicates event was cancelled.

    // Status values for a "VTODO"
    const VTODO_NEEDS_ACTION  = "NEEDS-ACTION";   // Indicates to-do needs action.
    const VTODO_COMPLETED     = "COMPLETED";      // Indicates to-do completed.
    const VTODO_IN_PROCESS    = "IN-PROCESS";     // Indicates to-do in process of
    const VTODO_CANCELLED     = "CANCELLED";      // Indicates to-do was cancelled.

    //Status values for "VJOURNAL".
    const VJOURNAL_DRAFT      = "DRAFT";          // Indicates journal is draft.
    const VJOURNAL_FINAL      = "FINAL";          // Indicates journal is final.
    const VJOURNAL_CANCELLED  = "CANCELLED";      // Indicates journal is removed.

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $value;
}
