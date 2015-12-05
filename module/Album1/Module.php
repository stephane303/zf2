<?php
namespace Album1;

 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 use Album1\Model\Album1Table;
 use Album1\Model\Album1;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway; 

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Album1\Model\Album1Table' =>  function($sm) {
                     $tableGateway = $sm->get('Album1TableGateway');
                     $table = new Album1Table($tableGateway);
                     return $table;
                 },
                 'Album1TableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Album1());
                     return new TableGateway('album1', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }     
 }