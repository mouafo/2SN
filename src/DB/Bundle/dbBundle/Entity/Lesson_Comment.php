<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lesson_Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\Lesson_CommentRepository")
 */
class Lesson_Comment
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
     * @ORM\Column(name="subject", type="string", length=200, nullable=true)
     */
    private $subject = null;
    
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
     * @ORM\ManyToOne(targetEntity="DB\Bundle\dbBundle\Entity\Lessons", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false) */
    private $lessons;
     

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
     * @return Lesson_Comment
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
     * @return Lessons
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
     * @return Lessons
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
     * Set lessons
     *
     * @param DB\Bundle\dbBundle\Entity\Lessons $lessons
     */
    public function setLessons(\DB\Bundle\dbBundle\Entity\Lessons $lessons)
    {
        $this->lessons = $lessons;
        
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
     * Get lessons
     *
     * @return DB\Bundle\dbBundle\Entity\Lessons
     */
    public function getLessons()
    {
        return $this->lessons;
    }
}
