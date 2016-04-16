<?php
 // Filename: /module/Blog/src/Blog/Factory/WriteControllerFactory.php
 namespace Album1\Factory;

 use Album1\Controller\Album1Controller;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class Album1ControllerFactory implements FactoryInterface
 {
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
        return new Album1Controller($serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default'));      
     }
 }