<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AlbumRest\Controller\TrackRest' => 'AlbumRest\Controller\TrackRestController',
            'AlbumRest\Controller\AlbumRest' => 'AlbumRest\Controller\AlbumRestController'
        )
    ),
 

    'router' => array(
        'routes' => array(
            'album-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/album-rest[/:album]',
                    'defaults' => array(
                        'controller' => 'AlbumRest\Controller\AlbumRest',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/track[/:track]',
                            'defaults' => array(
                                'controller' => 'AlbumRest\Controller\TrackRest'                                
                             ),                             
                         )
                     ),
                ),
            ),
        ),
    ),
    'view_manager' => array( 
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    )
);
       
    