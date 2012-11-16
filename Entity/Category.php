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
use IDCI\Bundle\SimpleScheduleBundle\Util\StringTools;

/**
 * @ORM\Table(name="idci_schedule_category")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $color;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\Category", inversedBy="childs")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\SimpleScheduleBundle\Entity\Category", mappedBy="parent")
     */
    protected $childs;

    /**
     * @ORM\ManyToMany(targetEntity="SchedulableElement", mappedBy="categories", cascade={"persist"})
     */
    private $elements;

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
     * Slugify
     *
     * @return string
     */
    public function slugify()
    {
        return StringTools::slugify($this->getName());
    }
}
