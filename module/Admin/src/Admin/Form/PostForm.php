<?php

namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter;
use Zend\InputFilter\FileInput;

class PostForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('admin');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Заголовок',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Заголовок',
            ),
        ));

        $this->add(array(
            'name' => 'categorie',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Категория',
                'value_options' => array(
                ),
            ),
        ));

        // File Input
        $file = new Element\File('image-file');
        $file->setLabel('Выберете изображение')
                ->setAttribute('id', 'image-file')
                ->setAttribute('title', 'Browse')
                ->setAttribute('class', 'fileupload');
        $this->add($file);


        $this->add(array(
            'name' => 'text',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
            //               'required' => 'false',
            ),
            'options' => array(
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Создать запись',
                'class' => 'btn small',
            ),
        ));
        
        $this->addInputFilter();
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        // File Input
        $fileInput = new InputFilter\FileInput('image-file');
        $fileInput->setRequired(true);


        $fileInput->getValidatorChain()
                ->attachByName('filesize', array('max' => 204800))
                ->attachByName('filemimetype', array('mimeType' => ['image/png',
                        'image/jpg', 'image/jpeg']))
                ->attachByName('fileimagesize', array('maxWidth' => 2000, 'maxHeight' => 2000));

        // All files will be renamed, i.e.:
        // ./data/tmpuploads/avatar_4b3403665fea6.png,
        // ./data/tmpuploads/avatar_5c45147660fb7.png
        $fileInput->getFilterChain()->attachByName(
                'filerenameupload', array(
            'target' => BASE_DIR . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
            'img' . DIRECTORY_SEPARATOR . 'upload' .
            DIRECTORY_SEPARATOR . 'image.jpg',
            'randomize' => true,
                )
        );

        $inputFilter->add($fileInput);
        
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

        $this->setInputFilter($inputFilter);
    }

}
