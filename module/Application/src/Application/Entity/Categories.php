<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Traits\JsonSerializeble;
use Application\Traits\OffsetSet;
/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories implements \Zend\Stdlib\JsonSerializable
{

    use JsonSerializeble,
        OffsetSet;

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
     * @ORM\Column(name="categorie_name", type="string", length=50, nullable=false)
     */
    private $categorieName;

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
     * Set categorieName
     *
     * @param string $categorieName
     * @return Categories
     */
    public function setCategorieName($categorieName)
    {
        $this->categorieName = $categorieName;

        return $this;
    }

    /**
     * Get categorieName
     *
     * @return string 
     */
    public function getCategorieName()
    {
        return $this->categorieName;
    }

    /**
     * getArrayCopy function.
     *
     * @access public
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
