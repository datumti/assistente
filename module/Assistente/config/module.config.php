<?php

namespace Assistente;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Assistente\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'assistente-interna' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action][/:id]]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                ),
            ),
            'assistente' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action][/page/:page]]',
                    'defaults' => array(
                        'action' => 'index',
                        'page' => 1
                    ),
                ),
            ),
            'assistente-auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        'action' => 'index',
                        'controller' => 'assitente/auth'
                    ),
                ),
            ),
            'assistente-logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/logout',
                    'defaults' => array(
                        'action' => 'logout',
                        'controller'=>'assitente/auth' 
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Assistente\Controller\Index' => 'Assistente\Controller\IndexController',
            'departamentos' => 'Assistente\Controller\DepartamentoController',
            'usuarios' => 'Assistente\Controller\UsuarioController',
            'assitente/auth' => 'Assistente\Controller\AuthController'
        ),
    ),
    #quando se tem vários módulos se adiciona esta linha para identificar o layout do módulo
    'module_layouts' => array(
        'Application' => 'layout/layout-application',
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'assistente/index/index' => __DIR__ . '/../view/assistente/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    'service_manager' => [
        'invokables' => [
            'UploadImagem' => 'Assistente\Service\UploadImagem'
        ]
    ]
);
