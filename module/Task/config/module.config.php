<?php
 namespace Task;

use Task\Controller\IndexController;
 return array(
     'controllers' => array(
//         'invokables' => array(
//             'Task\Controller\Index' => 'Task\Controller\IndexController',
//         ),
         'factories' => array (
             'Task\Controller\Index' => 'Task\Controller\IndexControllerFactory'
         ),
        'factories' => array(
            'Task\Controller\Index' => function($serviceLocator) {
                $ctr = new IndexController();
                $ctr->setGreetingService($serviceLocator->getServiceLocator()->get('Task\Service\Greeting'));

                return $ctr;
            }
        )         
     ),
     
     'service_manager' => array (
         'invokables' => array (
             'Task\Service\Greeting' => 'Task\Service\GreetingService'
         )
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'task' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/task[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Task\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'task' => __DIR__ . '/../view',
         ),
     ),
 );