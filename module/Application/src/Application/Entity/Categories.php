<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\AbstractEntity;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories extends AbstractEntity
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
     * @ORM\Column(name="categorie_name", type="string", length=50, nullable=false)
     */
    private $categorieName;

    /**
     * Set the id
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

}
