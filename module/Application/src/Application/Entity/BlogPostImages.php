<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPostImages
 *
 * @ORM\Table(name="blog_post_images")
 * @ORM\Entity
 */
class BlogPostImages
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
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path;

    /**
     * @var \Application\Entity\BlogPost
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\BlogPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;

    
    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\BlogPost", inversedBy="thumbnail")
     * @ORM\JoinColumn()
     */
    private $blogPost;

    
    public function getBlogPost()
    {
        return $this->blogPost;
    }

    
    public function setBlogPost($blogPost)
    {
        $this->blogPost = $blogPost;
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
     * Set path
     *
     * @param string $path
     * @return BlogPostImages
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set post
     *
     * @param \Application\Entity\BlogPost $post
     * @return BlogPostImages
     */
    public function setPost(\Application\Entity\BlogPost $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \Application\Entity\BlogPost 
     */
    public function getPost()
    {
        return $this->post;
    }
}