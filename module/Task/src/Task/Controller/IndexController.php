<?php
namespace Task\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $greetingService;
    
    public function setGreetingService ($service){
        $this->greetingService = $service;
    }
    
    public function indexAction()
    {
        #$s = $this->getServiceLocator()->get('Task\Service\Greeting');
        return new ViewModel(array('message' => 'Hello message!', 'service' => $this->greetingService));
    }
}

