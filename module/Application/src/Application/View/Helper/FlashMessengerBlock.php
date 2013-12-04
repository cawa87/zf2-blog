<?php

//namespace Application\View\Helper;
//@TODO create flashMessenger helper, to display block of messages
/**
 * Description of FlashMessenger
 *
 * @author cawa
 */

/**
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessengerBlock extends AbstractHelper
{
protected $fashMessenger;

public function __construct() {

$messenger = $this->flashMessenger()->getPluginFlashMessenger();
foreach (array(
FlashMessenger::NAMESPACE_ERROR,
 FlashMessenger::NAMESPACE_SUCCESS,
 FlashMessenger::NAMESPACE_INFO,
 FlashMessenger::NAMESPACE_DEFAULT)
as $namespace):

$messenger->setNamespace($namespace);
$userMsgs = array_merge($messenger->getCurrentMessages(), $messenger->getMessages());
$messenger->clearCurrentMessages();

foreach ($userMsgs as $msg):
$msgText = $msg;
if (is_array($msg)) {
$msgText = $msg['message'];
}
?>
<div class="alert alert-<?= $namespace ?>">
    <?= $msgText ?>
</div>
<?php endforeach ?>
<?php endforeach ?>
}

}
