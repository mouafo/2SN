<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group_Member
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\Group_MemberRepository")
 */
class Group_Member
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
     * @ORM\ManyToOne(targetEntity="DB\Bundle\dbBundle\Entity\Groups", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false) */
    private $groups;


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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Group_Member
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
     * @return Group_Member
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

    /**
     * Set user
     *
     * @param DB\Bundle\dbBundle\Entity\User $user
     */
    public function setUser(\DB\Bundle\dbBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set groups
     *
     * @param DB\Bundle\dbBundle\Entity\Groups $groups
     */
    public function setGroups(\DB\Bundle\dbBundle\Entity\Groups $groups)
    {
        $this->groups = $groups;
        
        return $this;
    }

    /**
     * Get user
     *
     * @return DB\Bundle\dbBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get groups
     *
     * @return DB\Bundle\dbBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
