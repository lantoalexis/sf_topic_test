<?php

namespace Mazecon\TopicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TopicUserView
 *
 * @ORM\Table(name="utilisateur_vu_topic")
 * @ORM\Entity(repositoryClass="Mazecon\TopicBundle\Repository\TopicUserViewRepository")
 */
class TopicUserView
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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="usersView")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     */
    private $topic;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usersView")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set topic
     *
     * @param \Mazecon\TopicBundle\Entity\Topic $topic
     *
     * @return TopicUserView
     */
    public function setTopic(\Mazecon\TopicBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \Mazecon\TopicBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set user
     *
     * @param \Mazecon\TopicBundle\Entity\User $user
     *
     * @return TopicUserView
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
}
