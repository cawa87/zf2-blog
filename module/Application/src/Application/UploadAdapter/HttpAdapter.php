<?php

namespace Application\UploadAdapter;

use Zend\File\Transfer\Adapter\Http as Adapter;
use Zend\Validator\File\Size;

/**
 * Description of HttpAdapter
 *
 * @author cawa
 */
class HttpAdapter
{

    protected $path;
    protected $adapter;

    public function __construct($options = array())
    {
        $this->adapter = new Adapter();

        $this->path = BASE_DIR . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
                'img' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR;

        $size = new Size(array('max' => 2000000));


        $this->adapter->addFilter('File\Rename', array('target' => $this->path .
            DIRECTORY_SEPARATOR . uniqid() . '.jpeg',
            'overwrite' => true));

        $this->adapter->addValidator($size);
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

}
