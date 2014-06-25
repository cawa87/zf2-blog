<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\AbstractEntity;

/**
 * Categories
 *
 * @ORM\Table(name="user_review")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class UserReview extends AbstractEntity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @var \Application\Entity\User
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=false)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    protected $text;

    /**
     * Set the id
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setUser(\Application\Entity\User $user)
    {
        $this->user = $user;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @ORM\PrePersist
     * @return BlogPost
     */
    public function setCreatedAt($createdAt = null)
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return strftime('%e %B %Y', $this->createdAt->getTimestamp());
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

}
