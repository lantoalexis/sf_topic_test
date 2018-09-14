<?php

namespace Mazecon\TopicBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Mazecon\TopicBundle\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Ce nom d'utilisateur existe déja, choisissez un autre")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50)
     */
    protected $username;


    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    protected $photo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    protected $birthdate;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="user")
     */
    protected $topics;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="TopicUserView", mappedBy="user")
     */
    protected $usersView;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="UserFos", mappedBy="user", cascade={"remove", "persist"})
     */
    protected $userFos;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add topic
     *
     * @param \Mazecon\TopicBundle\Entity\Topic $topic
     *
     * @return User
     */
    public function addTopic(\Mazecon\TopicBundle\Entity\Topic $topic)
    {
        $this->topics[] = $topic;

        return $this;
    }

    /**
     * Remove topic
     *
     * @param \Mazecon\TopicBundle\Entity\Topic $topic
     */
    public function removeTopic(\Mazecon\TopicBundle\Entity\Topic $topic)
    {
        $this->topics->removeElement($topic);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Set userFos
     *
     * @param \Mazecon\TopicBundle\Entity\UserFos $userFos
     *
     * @return User
     */
    public function setUserFos(\Mazecon\TopicBundle\Entity\UserFos $userFos = null)
    {
        $this->userFos = $userFos;

        return $this;
    }

    /**
     * Get userFos
     *
     * @return \Mazecon\TopicBundle\Entity\UserFos
     */
    public function getUserFos()
    {
        return $this->userFos;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Add usersView
     *
     * @param \Mazecon\TopicBundle\Entity\TopicUserView $usersView
     *
     * @return User
     */
    public function addUsersView(\Mazecon\TopicBundle\Entity\TopicUserView $usersView)
    {
        $this->usersView[] = $usersView;

        return $this;
    }

    /**
     * Remove usersView
     *
     * @param \Mazecon\TopicBundle\Entity\TopicUserView $usersView
     */
    public function removeUsersView(\Mazecon\TopicBundle\Entity\TopicUserView $usersView)
    {
        $this->usersView->removeElement($usersView);
    }

    /**
     * Get usersView
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersView()
    {
        return $this->usersView;
    }
}
