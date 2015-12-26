<?php

namespace Emion\RegisterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NPC
 *
 * @ORM\Table(name="npc")
 * @ORM\Entity(repositoryClass="Emion\RegisterBundle\Repository\NPCRepository")
 */
class NPC
{
  
    /**
     * @ORM\OneToMany(targetEntity="Emion\RegisterBundle\Entity\NPCBook", mappedBy="npc", orphanRemoval=true)
     */
    private $references;

    /**
    * @ORM\ManyToOne(targetEntity="Emion\RegisterBundle\Entity\Race", cascade={"persist"})
    */
    private $race;
    
    /**
    * @ORM\ManyToOne(targetEntity="Emion\RegisterBundle\Entity\Universe", cascade={"persist"})
    */
    private $universe;
    
    /**
    * @ORM\ManyToMany(targetEntity="Emion\RegisterBundle\Entity\Tag", cascade={"persist"})
    */
    private $tags;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="birth", type="integer", nullable=true)
     */
    private $birth;

    /**
     * @var int
     *
     * @ORM\Column(name="death", type="integer", nullable=true)
     */
    private $death;

    /**
     * @var string
     *
     * @ORM\Column(name="activity", type="string", length=255)
     */
    private $activity;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return NPC
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
     *
     * @return NPC
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
     * Set location
     *
     * @param string $location
     *
     * @return NPC
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set birth
     *
     * @param integer $birth
     *
     * @return NPC
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * Get birth
     *
     * @return int
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set death
     *
     * @param integer $death
     *
     * @return NPC
     */
    public function setDeath($death)
    {
        $this->death = $death;

        return $this;
    }

    /**
     * Get death
     *
     * @return int
     */
    public function getDeath()
    {
        return $this->death;
    }

    /**
     * Set activity
     *
     * @param string $activity
     *
     * @return NPC
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set race
     *
     * @param \Emion\RegisterBundle\Entity\Race $race
     *
     * @return NPC
     */
    public function setRace(\Emion\RegisterBundle\Entity\Race $race = null)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return \Emion\RegisterBundle\Entity\Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Add tag
     *
     * @param \Emion\RegisterBundle\Entity\Tag $tag
     *
     * @return NPC
     */
    public function addTag(\Emion\RegisterBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Emion\RegisterBundle\Entity\Tag $tag
     */
    public function removeTag(\Emion\RegisterBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set universe
     *
     * @param \Emion\RegisterBundle\Entity\Universe $universe
     *
     * @return NPC
     */
    public function setUniverse(\Emion\RegisterBundle\Entity\Universe $universe = null)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Get universe
     *
     * @return \Emion\RegisterBundle\Entity\Universe
     */
    public function getUniverse()
    {
        return $this->universe;
    }
}
