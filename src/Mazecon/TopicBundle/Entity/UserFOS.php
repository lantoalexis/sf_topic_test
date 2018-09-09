<?php

namespace Mazecon\TopicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * UserFOS
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Mazecon\TopicBundle\Repository\UserFOSRepository")
 */
class UserFOS extends BaseUser
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
     * @var
     * @ORM\OneToOne(targetEntity="User", inversedBy="userFos", cascade={"remove", "persist"})
     */
    protected $user;

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
     * @return UserFOS
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
