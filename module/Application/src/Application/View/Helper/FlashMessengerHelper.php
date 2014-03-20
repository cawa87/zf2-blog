<?php

namespace Application\View\Helper;

//@TODO create flashMessenger helper, to display block of messages
/**
 * Description of FlashMessenger
 *
 * @author cawa
 */
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessengerHelper extends AbstractHelper
        implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

    protected $namespaces = [
        FlashMessenger::NAMESPACE_ERROR,
        FlashMessenger::NAMESPACE_SUCCESS,
        FlashMessenger::NAMESPACE_INFO,
        FlashMessenger::NAMESPACE_DEFAULT];

    public function __invoke()
    {
        $messenger = $this->getServiceLocator()->get('flashMessenger')->getPluginFlashMessenger();

        foreach ($this->namespaces as $namespace) {

            $messenger->setNamespace($namespace);
            $userMsgs = array_merge($messenger->getCurrentMessages(), $messenger->getMessages());
            $messenger->clearCurrentMessages();

            foreach ($userMsgs as $msg) {
                $msgText = $msg;
                if (is_array($msg)) {
                    $msgText = $msg['message'];
                }
                $output = '<div class="alert alert-' . $namespace . '">';
                $output .= $msgText;
                $output .= '</div>';
                return $output;
            }
        }
    }

}
