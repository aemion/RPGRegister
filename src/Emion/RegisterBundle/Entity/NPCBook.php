<?php

namespace Emion\RegisterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NPCBook
 *
 * @ORM\Table(name="npc_book")
 * @ORM\Entity
 */
class NPCBook
{
    /**
    * @ORM\ManyToOne(targetEntity="Emion\RegisterBundle\Entity\NPC")
    * @ORM\JoinColumn(nullable=false)
    */
    private $npc;
    
    /**
    * @ORM\ManyToOne(targetEntity="Emion\RegisterBundle\Entity\Book")
    * @ORM\JoinColumn(nullable=false)
    */
    private $book;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="page", type="integer")
     */
    private $page;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $details;


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
     * Set page
     *
     * @param integer $page
     *
     * @return NPCBook
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set npc
     *
     * @param \Emion\RegisterBundle\Entity\NPC $npc
     *
     * @return NPCBook
     */
    public function setNpc(\Emion\RegisterBundle\Entity\NPC $npc)
    {
        $this->npc = $npc;

        return $this;
    }

    /**
     * Get npc
     *
     * @return \Emion\RegisterBundle\Entity\NPC
     */
    public function getNpc()
    {
        return $this->npc;
    }

    /**
     * Set book
     *
     * @param \Emion\RegisterBundle\Entity\Book $book
     *
     * @return NPCBook
     */
    public function setBook(\Emion\RegisterBundle\Entity\Book $book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \Emion\RegisterBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return NPCBook
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }
}
