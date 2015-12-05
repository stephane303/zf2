<?php

// Filename: /module/Blog/config/module.config.php
return array(
     'db' => array(
         'driver'         => 'Pdo',
         #'username'       => 'SECRET_USERNAME',  //edit this
         #'password'       => 'SECRET_PASSWORD',  //edit this
         'dsn'            => 'mysql:dbname=test;host=localhost',
         'driver_options' => array(
             \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
         )
     ),    
     'service_manager' => array(
         'factories' => array(
             'Blog\Mapper\PostMapperInterface'   => 'Blog\Factory\ZendDbSqlMapperFactory',             
             'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
             'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'             
         )
     ),    
    'controllers' => array(
        'factories' => array(
            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),   
    // This lines opens the configuration for the RouteManager
    'router' => array(
         'routes' => array(
             'blog' => array(
                 'type' => 'literal',
                 'options' => array(
                     'route'    => '/blog',
                     'defaults' => array(
                         'controller' => 'Blog\Controller\List',
                         'action'     => 'index',
                     ),
                 ),
                 'may_terminate' => true,
                 'child_routes'  => array(
                     'detail' => array(
                         'type' => 'segment',
                         'options' => array(
                             'route'    => '/:id',
                             'defaults' => array(
                                 'action' => 'detail'
                             ),
                             'constraints' => array(
                                 'id' => '[1-9]\d*'
                             )
                         )
                     )
                 )
             )
         )
     )
);

