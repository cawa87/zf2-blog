<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testController
 *  controller for all uploading
 * @author Cawa
 */
namespace Application\Controller;


use Zend\View\Model\ViewModel;
use Application\Form\ImageUploadForm;
use Application\Controller\AbstractController;

class UploadController extends AbstractController
{
    
    
    public function indexAction()
    {
        
    }
    
    public function uploadAction()
    {
        
        $form = new ImageUploadForm('upload-form',null,'1');
        
        $tempFile = null;
        
        $prg = $this->fileprg($form,'upload',true);
        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            return $prg; // Return PRG redirect response
        } elseif (is_array($prg)) {
            if ($form->isValid()) {
                $data = $form->getData();
                // Form is valid, save the form!
                $tempImgName = explode('public',$data['image-file']['tmp_name']);
                $success = new ViewModel(['img'=>  str_replace('\\', '/', $tempImgName[1])]);
                $success->setTemplate('application/upload/success.phtml');
                return $success;
                //$this->redirect()->toRoute('application',['controller'=>'upload','action'=>'success']);
            } else {
                // Form not valid, but file uploads might be valid...
                // Get the temporary file information to show the user in the view
                $fileErrors = $form->get('image-file')->getMessages();
                if (empty($fileErrors)) {
                    $tempFile = $form->get('image-file')->getValue();
                }
            }
        }

        return array(
            'form' => $form,
            'tempFile' => $tempFile,
        );
    }
    
    public function successAction()
    {
        
    }
}
