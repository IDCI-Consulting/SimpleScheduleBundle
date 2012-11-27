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
 * This entity is based on the "VEVENT", "VTODO", "VJOURNAL" Component from the RFC2445
 *
 * Purpose: Provide a grouping of component properties that describe a journal.
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\JournalRepository")
 */
class Journal extends CalendarEntity
{
}
