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

/**
 * @ORM\Table(name="idci_schedule_location")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    protected $latitude;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    protected $longitude;

    /**
     * @ORM\OneToMany(targetEntity="LocationAwareCalendarEntity", mappedBy="location")
     */
    protected $locationAwareCalendarEntities;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * getGeo
     *
     * @return string
     */
    public function getGeo()
    {
        return sprintf('%.6f;%.6f', $this->getLatitude(), $this->getLongitude());
    }
}
