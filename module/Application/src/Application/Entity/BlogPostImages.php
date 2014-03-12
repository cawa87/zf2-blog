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
     * @ORM\OneToOne(targetEntity="Application\Entity\BlogPost",inversedBy="image",cascade={"persist", "remove"})
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path;

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
     * Set post
     *
     * @param integer $post
     * @return BlogPostImages
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Get post
     *
     * @return integer 
     */
    public function getPost()
    {
        return $this->post;
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
     * Populate current object with data
     * @param $data
     * @return Entity
     */
    public function fromArray(array $data = array())
    {

        foreach ($data as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (method_exists($this, $setter))
                $this->$setter($value);
            elseif (property_exists($this, $property))
                $this->$property = $value;
        }
        return $this;
    }

}
