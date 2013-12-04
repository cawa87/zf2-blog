<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_D87F7E0C1E5D0459", columns={"test_id"})})
 * @ORM\Entity
 */
class Test
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
     * @var \Application\Entity\TestInfo
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TestInfo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     * })
     */
    private $test;



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
     * Set test
     *
     * @param \Application\Entity\TestInfo $test
     * @return Test
     */
    public function setTest(\Application\Entity\TestInfo $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \Application\Entity\TestInfo 
     */
    public function getTest()
    {
        return $this->test;
    }
}
