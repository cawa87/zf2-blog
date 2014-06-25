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

class UserReviewForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        

        $username = new Element\Text('username');
        $username->setLabel('Ваша фамилия, имя');
        $username->setAttribute('required', true);
        $this->add($username);
        
        $email = new Element\Email('email');
        $email->setLabel('Ваш email, не обязятельно');
        $this->add($email);

        $text = new Element\Textarea('text');
        $text->setLabel('Ваш отзыв')
                ->setAttribute('cols', '1')
                ->setAttribute('class', 'input-large')
                ->setAttribute('rows', '10');

        $this->add($text);


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Оставить',
                'class' => 'btn small',
            ),
            'options' => array(
                'label' => ' ',
            ),
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(5, 50))
            ),
        ));
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $nameInput = new InputFilter\Input('email');
        $nameInput->setRequired(false);

        $inputFilter->add($nameInput);

        $this->setInputFilter($inputFilter);
    }

}
