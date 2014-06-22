<?php

/**
 * Description of WatermarkHelper
 *
 * @author Cawa
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class WatermarkHelper extends AbstractHelper
{

    public function __invoke($imagePath)
    {


        $stamp = imagecreatefrompng(BASE_DIR .'/public/img/logo.png');
        $im = imagecreatefromjpeg(BASE_DIR.'/public/img/gallery/532f0e14f4087.jpeg');

        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);


    }

}
