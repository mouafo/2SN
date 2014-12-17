<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MultimediaComment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\MultimediaCommentRepository")
 */
class MultimediaComment
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
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

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
    private $user_create;
     
    /**
     * @ORM\ManyToOne(targetEntity="DB\Bundle\dbBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false) */
    private $user_comment;
     
    /**
     * @ORM\ManyToOne(targetEntity="DB\Bundle\dbBundle\Entity\Multimedia", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false) */
    private $multimedia;
     
    
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
     * Set comment
     *
     * @param string $comment
     * @return MultimediaComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return MultimediaComment
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
     * @return MultimediaComment
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
     * Set user_create
     *
     * @param DB\Bundle\dbBundle\Entity\User $user_create
     */
    public function setUser_create(\DB\Bundle\dbBundle\Entity\User $user)
    {
        $this->user_create = $user;

        return $this;
    }

    /**
     * Set user_comment
     *
     * @param DB\Bundle\dbBundle\Entity\User $user_comment
     */
    public function setUser_comment(\DB\Bundle\dbBundle\Entity\User $user)
    {
        $this->user_comment = $user;

        return $this;
    }

    /**
     * Set multimedia
     *
     * @param DB\Bundle\dbBundle\Entity\Multimedia $multimedia
     */
    public function setMultimedia(\DB\Bundle\dbBundle\Entity\Multimedia $multimedia)
    {
        $this->multimedia = $multimedia;
        
        return $this;
    }

    /**
     * Get user_create
     *
     * @return DB\Bundle\dbBundle\Entity\User
     */
    public function getUser_create()
    {
        return $this->user_create;
    }

    /**
     * Get user_comment
     *
     * @return DB\Bundle\dbBundle\Entity\User
     */
    public function getUser_comment()
    {
        return $this->user_comment;
    }

    /**
     * Get multimedia
     *
     * @return DB\Bundle\dbBundle\Entity\Multimedia
     */
    public function getMultimedia()
    {
        return $this->multimedia;
    }
}
