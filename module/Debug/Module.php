<?php

namespace Debug;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\EventManager\Event;
use Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProviderInterface {

    public function init(ModuleManager $moduleManager) {

        $eventManager = StaticEventManager::getInstance();

        //$eventManager->attach(ModuleEvent::EVENT_LOAD_MODULES_POST, array($this, 'loadedModulesInfo'));
        $eventManager->attach('*','*', array($this, 'anyEvent'));
    }

    public function loadedModulesInfo(Event $event) {

        $moduleManager = $event->getTarget();

        $loadedModules = $moduleManager->getLoadedModules();

        error_log(var_export($loadedModules, true));
    }
    
    public function anyEvent(Event $event) {
        error_log($event->getName());
    }    

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );        
    }

}