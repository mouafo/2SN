<?php

namespace DB\Bundle\dbBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DB\Bundle\dbBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name = null;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=150, nullable=true)
     */
    private $surname = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="born_date", type="date", nullable=true)
     */
    private $bornDate = null;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=150, nullable=true)
     */
    private $job = null;

    /**
     * @var string
     *
     * @ORM\Column(name="competence1", type="string", length=150, nullable=true)
     */
    private $competence1 = null;

    /**
     * @var string
     *
     * @ORM\Column(name="competence2", type="string", length=150, nullable=true)
     */
    private $competence2 = null;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="connected", type="boolean")
     */
    private $connected;

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

    public function __construct()
    {
        parent::__construct();
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
     * Set connected
     *
     * @param \Boolean $connected
     *
     */
    public function setConnected($connected)
    {
        $this->connected = $connected;
    }

    /**
     * Get connected
     *
     * @return \Boolean
     */
    public function getConnected()
    {
        return $this->connected;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set bornDate
     *
     * @param \DateTime $bornDate
     * @return User
     */
    public function setBornDate($bornDate)
    {
        $this->bornDate = $bornDate;

        return $this;
    }

    /**
     * Get bornDate
     *
     * @return \DateTime 
     */
    public function getBornDate()
    {
        return $this->bornDate;
    }

    /**
     * Set job
     *
     * @param string $job
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set competence1
     *
     * @param string $competence1
     * @return User
     */
    public function setCompetence1($competence1)
    {
        $this->competence1 = $competence1;

        return $this;
    }
    public function getCompetence1()
    {

        return $this->competence1;
    }
    /**
     * Get competence1
     *
     * @return string
     */

    /**
     * Set competence2
     *
     * @param string $competence2
     * @return competence2
     */
    public function setCompetence2($competence2)
    {
        $this->competence2 = $competence2;

        return $this;
    }
    public function getCompetence2()
    {

        return $this->competence2;
    }
    /**
     * Get competence1
     *
     * @return string
     */

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return User
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
     * @return User
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
