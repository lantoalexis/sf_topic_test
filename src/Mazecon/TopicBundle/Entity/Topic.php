<?php

namespace Mazecon\TopicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="Mazecon\TopicBundle\Repository\TopicRepository")
 */
class Topic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User", inversedBy="topics")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="TopicUserView", mappedBy="topic")
     */
    protected $usersView;


//    /**
//     * @var
//     * @ORM\ManyToMany(targetEntity="User", inversedBy="topics")
//     * @ORM\JoinTable(name="user_view_topic,
//     *     joinColumns={@ORM\JoinColumn(name="topic_id", referencedColumnName="id")},
//     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
//     *     )
//     */
//    private $users;


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
     * Set user
     *
     * @param \Mazecon\TopicBundle\Entity\User $user
     *
     * @return Topic
     */
    public function setUser(\Mazecon\TopicBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Mazecon\TopicBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Topic
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
     * Constructor
     */
    public function __construct()
    {
        $this->usersView = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usersView
     *
     * @param \Mazecon\TopicBundle\Entity\TopicUserView $usersView
     *
     * @return Topic
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
