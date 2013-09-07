<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
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
     @ORM\Column(name="test_id", type="integer", nullable=false)
    *
    */
    private $test_id;
    
    /**
     * @var \Application\Entity\TestInfo
     *
     * @ORM\OneToOne(targetEntity="Application\Entity\TestInfo")
     * @ORM\JoinColumn()
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
     * Set testId
     *
     * @param integer $testId
     * @return Test
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;
    
        return $this;
    }

    /**
     * Get testId
     *
     */
    public function getTest()
    {
        return $this->test;
    }
    
    
    public function getTestId() 
    {
        return $this->test_id;
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
}