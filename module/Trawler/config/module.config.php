<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Trawler\Controller\Trawler' => 'Trawler\Controller\TrawlerController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'trawler' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/trawler[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Trawler\Controller\Trawler',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'trawler' => __DIR__ . '/../view',
        ),
    ),
);