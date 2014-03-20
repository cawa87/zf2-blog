<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of GalleryImage
 *
 * @author cawa
 */

/**
 * BlogPost
 *
 * @ORM\Table(name="galleryImage")
 * @ORM\Entity(repositoryClass="\Application\Repository\GalleryImageRepository")
 */
class GalleryImage
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", nullable=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private $title;
    

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function setTitle($title)
    {
        $this->title = $title;
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
