<?php

namespace Emion\RegisterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="book", uniqueConstraints={@ORM\UniqueConstraint(name="book_unique", columns={"name", "universe_id"})})
 * @ORM\Entity(repositoryClass="Emion\RegisterBundle\Repository\BookRepository")
 * @UniqueEntity({"name", "universe"})
 */
class Book
{
    /**
     * @ORM\OneToMany(targetEntity="Emion\RegisterBundle\Entity\NPCBook", mappedBy="book", orphanRemoval=true)
     */
    private $references;
    
    /**
    * @ORM\ManyToOne(targetEntity="Emion\RegisterBundle\Entity\Universe", cascade={"persist"})
    * @ORM\JoinColumn(name="universe_id", referencedColumnName="id")
    */
    private $universe;
    
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
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


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
     * @return Book
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
     * @return Book
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
     * Set universe
     *
     * @param \Emion\RegisterBundle\Entity\Universe $universe
     *
     * @return Book
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
    
    /**
     * Get unique name (name + universe)
     *
     * @return string
     */
    public function getUniqueName() {
      return $this->getName()." (".$this->getUniverse()->getName().")";
    }
}
