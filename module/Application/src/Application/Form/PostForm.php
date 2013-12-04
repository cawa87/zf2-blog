<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form;

/**
 * Description of ImageUploadForm
 *
 *  Form for uploading user images
 * @author Cawa
 */
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class PostForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        // File Input
        $name = new Element\Text('categorieName');
        $name->setLabel('Select categorie name');
        $this->add($name);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Create',
                'class' => 'btn small',
            ),
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(5, 50))
            ),
        ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'text',
                'readonly' => 'true'
            ),
            'options' => array(
            ),
        ));
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $nameInput = new InputFilter\Input('categorieName');
        $nameInput->setRequired(true);

        $inputFilter->add($nameInput);

        $this->setInputFilter($inputFilter);
    }

    public function setUserId($userId)
    {
        
    }

}
