<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IDCI\Bundle\SimpleScheduleBundle\Util\StringTools;

/**
 * @ORM\Table(name="idci_schedule_category")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\SimpleScheduleBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $level;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $tree;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="childs")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $childs;

    /**
     * @ORM\ManyToMany(targetEntity="CalendarEntity", mappedBy="categories", cascade={"persist"})
     */
    private $calendarEntities;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        if($this->getParent()) {
            return sprintf('%s > %s',
                $this->getParent(),
                $this->getName()
            );
        }

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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calendarEntities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * hasParent
     *
     * @return boolean
     */
    public function hasParent()
    {
        return null !== $this->getParent();
    }

    /**
     * buildTree
     *
     * @return string
     */
    public function buildTree()
    {
        if(!$this->hasParent()) {
            return null;
        }

        return sprintf('%s%s%d',
            $this->getParent()->getTree(),
            null !== $this->getParent()->getTree() ? '-': '',
            $this->getParent()->getId()
        );
    }

    /**
     * countLevel
     *
     * @return integer
     */
    public function countLevel()
    {
        if(!$this->hasParent()) {
            return 0;
        }

        return $this->getParent()->getLevel() + 1;
    }

    /**
     * onUpdate
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function onUpdate()
    {
        $now = new \DateTime('now');

        $this->setTree($this->buildTree());
        $this->setLevel($this->countLevel());
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Category
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        if(null === $this->color && $this->hasParent()) {
            return $this->getParent()->getColor();
        }

        return $this->color;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Category
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return null !== $this->level ? $this->level : $this->countLevel();
    }

    /**
     * Set tree
     *
     * @param string $tree
     * @return Category
     */
    public function setTree($tree)
    {
        $this->tree = $tree;
    
        return $this;
    }

    /**
     * Get tree
     *
     * @return string 
     */
    public function getTree()
    {
        return null !== $this->tree ? $this->tree : $this->buildTree();
    }

    /**
     * Set parent
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\IDCI\Bundle\SimpleScheduleBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \IDCI\Bundle\SimpleScheduleBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add childs
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\Category $childs
     * @return Category
     */
    public function addChild(\IDCI\Bundle\SimpleScheduleBundle\Entity\Category $childs)
    {
        $this->childs[] = $childs;
    
        return $this;
    }

    /**
     * Remove childs
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\Category $childs
     */
    public function removeChild(\IDCI\Bundle\SimpleScheduleBundle\Entity\Category $childs)
    {
        $this->childs->removeElement($childs);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Add calendarEntities
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities
     * @return Category
     */
    public function addCalendarEntitie(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities)
    {
        $this->calendarEntities[] = $calendarEntities;
    
        return $this;
    }

    /**
     * Remove calendarEntities
     *
     * @param \IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities
     */
    public function removeCalendarEntitie(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $calendarEntities)
    {
        $this->calendarEntities->removeElement($calendarEntities);
    }

    /**
     * Get calendarEntities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalendarEntities()
    {
        return $this->calendarEntities;
    }
}
