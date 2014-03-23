<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\AbstractEntity;

/**
 * BlogPost
 *
 * @ORM\Table(name="blog_post")
 * @ORM\Entity(repositoryClass="\Application\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks
 */
class BlogPost extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    private $text;

    /**
     * @var integer
     *
     * @ORM\Column(name="author_id", type="integer", nullable=true)
     */
    private $authorId;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\BlogPostImages", mappedBy="post", cascade={"remove"})
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="comments", type="integer", nullable=true)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Categories")
     * @var \Application\Entity\Categories
     */
    private $categorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
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
     * @return BlogPost
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
     * Set text
     *
     * @param string $text
     * @return BlogPost
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set authorId
     *
     * @param integer $authorId
     * @return BlogPost
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer 
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set thumbnailId
     *
     * @param integer $thumbnailId
     * @return BlogPost
     */
    public function setThumbnailId($thumbnailId)
    {
        $this->thumbnailId = $thumbnailId;

        return $this;
    }

    /**
     * Get thumbnailId
     *
     * @return integer 
     */
    public function getThumbnailId()
    {
        return $this->thumbnailId;
    }

    /**
     * Get thumbnail
     *
     * @return path
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set comments
     *
     * @param integer $comments
     * @return BlogPost
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return integer 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set categorieId
     *
     * @param integer $categorie
     * @return BlogPost
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorieId
     *
     * @return integer 
     */
    public function getCategorie()
    {
        return $this->categorie;
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
        return $this->createdAt;
    }



}
