<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partner
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\PartnerRepository")
 */
class Partner
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
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="Active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edit_date", type="datetime")
     */
    private $editDate;

    /**
     * @ORM\ManyToOne(targetEntity="DB\Bundle\dbBundle\Entity\User", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false) */
	private $user;
     
    /**
     * @ORM\ManyToOne(targetEntity="DB\Bundle\dbBundle\Entity\User", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false) */
	private $user_partner;
     

    public function __construct() {
        $this->setCreateDate(new \Datetime());
        $this->setEditDate($this->getCreateDate());
        $this->active = false; 
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
     * Set active
     *
     * @param \Boolean $active
     *
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return \Boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
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
     * 
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;
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
    
	/**
	 * Set user
	 *
	 * @param DB\Bundle\dbBundle\Entity\User $user
     */
	public function setUser(\DB\Bundle\dbBundle\Entity\User $user)
	{
		$this->user = $user;
	}

    /**
     * Set user_partner
     *
     * @param DB\Bundle\dbBundle\Entity\User $user_partner
     */
    public function setUserPartner(\DB\Bundle\dbBundle\Entity\User $user)
    {
        $this->user_partner = $user;
    }

    /**
     * Get user
     *
     * @return DB\Bundle\dbBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;

        return $this;
    }

    /**
     * Get user_partner
     *
     * @return DB\Bundle\dbBundle\Entity\User
     */
    public function getUserPartner()
    {
        return $this->user_partner;
        
        return $this;
    }
}
