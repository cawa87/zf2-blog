<?php

namespace Admin\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PostFormValidator implements InputFilterAwareInterface
{

    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();


            $inputFilter->add($factory->createInput([
                        'name' => 'text',
                        'required' => 0,
                        'filters' => array(
                        // array('name' => 'StripTags'),
                        // array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                        ),
            ]));


            
            
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
