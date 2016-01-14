<?php

namespace Assistente\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Session\Container;

use Assistente\Form\Login as LoginForm;

class AuthController extends AbstractActionController {

    public function indexAction() {

        $form = new LoginForm;
        $error = false;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();

                $auth = new AuthenticationService;

                $sessionStorage = new SessionStorage("AssistenteAdmin");
                $auth->setStorage($sessionStorage);

                $authAdapter = $this->getServiceLocator()->get('Assitente\Auth\Adapter');
                $authAdapter->setUsername($data['email'])
                        ->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    
                    $dadosUsuario = $auth->getIdentity()['user'];
                    
                    //cria um container(sessao) chamada usuario 
                    $user_session = new Container('usuario');
                    $user_session->id = $dadosUsuario['id'];
                    $user_session->nome = $dadosUsuario['nome']; 
                    $user_session->matricula = $dadosUsuario['matricula']; 
                    $user_session->foto = $dadosUsuario['foto'];
                    $user_session->dataNascimento = $dadosUsuario['dataNascimento'];  
                    $user_session->email = $dadosUsuario['email'];
                    
                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    return $this->redirect()->toRoute("assistente", array('controller' => 'usuarios'));
                    
                }else
                    $error = true;
            }
        }
        
        return new ViewModel(array('form'=>$form,'error'=>$error));
    }
    
    public function logoutAction() {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('AssistenteAdmin'));
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('assistente-auth'); 
    }

}