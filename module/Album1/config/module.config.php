<?php
 namespace Album1;
 return array(
     'controllers' => array(
         'invokables' => array(
             'Album1\Controller\Album1' => 'Album1\Controller\Album1Controller',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'album1' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/album1[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Album1\Controller\Album1',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'album1' => __DIR__ . '/../view',
         ),
     ),
 );