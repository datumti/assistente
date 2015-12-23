<?php

namespace Assistente;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use Assistente\Service\Departamentos as DepartamentoService;
use Assistente\Service\Usuarios as UsuarioService;
use Assistente\Form\Usuario as FrmUsuario;
use Assistente\Auth\Adapter as AuthAdapter;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ . "Admin" => __DIR__ . '/src/' . __NAMESPACE__ . "Admin",
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /* public function onBootstrap($e) {
      $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
      $controller = $e->getTarget();
      $controllerClass = get_class($controller);
      $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
      $config = $e->getApplication()->getServiceManager()->get('config');
      if (isset($config['module_layouts'][$moduleNamespace])) {
      $controller->layout($config['module_layouts'][$moduleNamespace]);
      }
      }, 98);
      } */

    public function init(ModuleManager $moduleManager) {
        
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        
        $sharedEvents->attach("Assistente", 'dispatch', function($e) {
            
            $auth = new AuthenticationService;
            $auth->setStorage(new SessionStorage("AssistenteAdmin"));

            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

            if (!$auth->hasIdentity() and ($matchedRoute == "assistente" or $matchedRoute == "assistente-interna")) {
                return $controller->redirect()->toRoute('assistente-auth');
            }
        }, 99);
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Assistente\Service\Departamento' => function($service) {
                    return new DepartamentoService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Assistente\Service\Usuario' => function($service) {
                    return new UsuarioService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Assistente\Form\Usuario' => function($service) {

                    $em = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Assistente\Entity\Departamento');
                    $departamentos = $repository->fetchPairs();

                    return new FrmUsuario(null, $departamentos);
                },
                'Assitente\Auth\Adapter' => function($service) {
                    return new AuthAdapter($service->get('Doctrine\ORM\EntityManager'));
                }
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity()
            )
        );
    }

}
