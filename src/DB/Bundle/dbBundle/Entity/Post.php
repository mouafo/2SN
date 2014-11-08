<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\PostRepository")
 */
class Post
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
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

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
     * Set subject
     *
     * @param string $subject
     * @return Post
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Post
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
     * @return Post
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
     * Get user
     *
     * @return DB\Bundle\dbBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
