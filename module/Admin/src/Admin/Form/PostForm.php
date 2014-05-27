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
       // $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Заголовок',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Заголовок',
                'label_attributes' => array(
                    'class' => 'control-label',
                    'element' => '<h1>'
                ),
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
        $file->setLabel('Выбирете изображение')
                ->setAttribute('id', 'image-file')
                ->setAttribute('title', 'Выбрать...')
                ->setAttribute('required', 'required')
                ->setAttribute('class', 'fileupload');
        $this->add($file);


        $this->add(array(
            'name' => 'text',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
            //               'required' => 'false',
                'id' => 'editor1',
                'rows' => 15
            ),
            'options' => array(
                'label' => 'Запись',
                
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Создать запись',
                'class' => 'btn small',
            ),
            'options' => array(
                'label' => '',
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
                ->attachByName('filesize', array('max' => 504800))
                ->attachByName('filemimetype', array('mimeType' => ['image/png',
                        'image/jpg', 'image/jpeg']))
                ->attachByName('fileimagesize', array('maxWidth' => 2500, 'maxHeight' => 2500));

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
