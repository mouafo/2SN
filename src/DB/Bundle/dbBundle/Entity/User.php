<?php

namespace DB\Bundle\dbBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

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


    /**
     * @Assert\File(
     *     mimeTypes={"image/png", "image/jpeg", "image/gif"}
     * )
     * @Vich\UploadableField(mapping="profile_images", fileNameProperty="imageName")
     *
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     *
     * @var string $imageName
     */
    protected $imageName;

    public function __construct()
    {
        parent::__construct();
        $this->connected = FALSE;
        $this->setCreateDate(new \Datetime());
        $this->setEditDate($this->getCreateDate());
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->editDate = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
