<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\AvisRepository")
 */
class Avis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="favorable", type="boolean")
     */
    private $favorable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unfavorable", type="boolean")
     */
    private $unfavorable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edit_date", type="datetime")
     */
    private $editDate;


    public function __construct() {
        $this->setCreateDate(new \Datetime());
        $this->setEditDate($this->getCreateDate());
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
     * Set favorable
     *
     * @param boolean $favorable
     * @return Avis
     */
    public function setFavorable($favorable)
    {
        $this->favorable = $favorable;

        return $this;
    }

    /**
     * Get favorable
     *
     * @return boolean 
     */
    public function getFavorable()
    {
        return $this->favorable;
    }

    /**
     * Set unfavorable
     *
     * @param boolean $unfavorable
     * @return Avis
     */
    public function setUnfavorable($unfavorable)
    {
        $this->unfavorable = $unfavorable;

        return $this;
    }

    /**
     * Get unfavorable
     *
     * @return boolean 
     */
    public function getUnfavorable()
    {
        return $this->unfavorable;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Avis
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set editDate
     *
     * @param \DateTime $editDate
     * @return Avis
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;

        return $this;
    }

    /**
     * Get editDate
     *
     * @return \DateTime 
     */
    public function getEditDate()
    {
        return $this->editDate;
    }
}
