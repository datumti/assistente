<?php

namespace Assistente;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Session\Container;

use Assistente\Service\Departamentos as DepartamentoService;
use Assistente\Service\Usuarios as UsuarioService;
use Assistente\Form\Usuario as FrmUsuario;
use Assistente\Auth\Adapter as AuthAdapter;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

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

    public function onBootstrap($e) {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'loadConfiguration' ));
    }
    
    public function loadConfiguration(MvcEvent $e)
    {           
          $controller = $e->getTarget();
          
          $user_session = new Container('usuario');
          
          $controller->layout()->nome = trim(substr($user_session->nome, 0, 16));   
          $controller->layout()->foto = $user_session->foto ? "/fotos/" . str_replace(" ", "_",$user_session->foto) : "/fotos/default.jpg"; 
    }

    public function init(ModuleManager $moduleManager) {
        
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        
        $sharedEvents->attach("Assistente", 'dispatch', function($e) {
            
            $auth = new AuthenticationService;
            $auth->setStorage(new SessionStorage("AssistenteAdmin"));

            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

            if (!$auth->hasIdentity() and ($matchedRoute == "home" or $matchedRoute == "assistente" or $matchedRoute == "assistente-interna")) {  
            //if (!$auth->hasIdentity()) { 
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
