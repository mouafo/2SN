<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lessons
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\LessonsRepository")
 */
class Lessons
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
     * @ORM\Column(name="title", type="string", length=160, nullable=true)
     */
    private $title = null;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="text", nullable=true)
     */
    private $subject = null;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255, nullable=true)
     */
    private $file = null;

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
     * Set title
     *
     * @param string $title
     * @return Lessons
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Lessons
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
     * Set file
     *
     * @param string $file
     * @return Lessons
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
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
