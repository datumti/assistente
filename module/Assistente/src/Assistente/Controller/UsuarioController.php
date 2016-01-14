<?php

namespace Assistente\Controller;

use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class UsuarioController extends CrudController {

    public function __construct() {
        $this->entity = "Assistente\Entity\Usuario";
        $this->form = "Assistente\Form\Usuario";
        $this->service = "Assistente\Service\Usuario";
        $this->controller = "usuarios";
        $this->route = "assistente";
    }

    public function indexAction() {
        
        $list = $this->getEm()
                ->getRepository($this->entity)
                ->findBy(array('ativo' => '1'), array('nome' => 'asc'));

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(20);

        return new ViewModel(array('data' => $paginator, 'page' => $page));
    }

    public function newAction() {
        $form = $this->getServiceLocator()->get($this->form);

        $request = $this->getRequest();

        if ($request->isPost()) {
            
            $dados = $request->getPost();
            
            $dados['ativo'] = 1;
            
            $form->setData($dados);
            
            if ($form->isValid()) {

                $nonFile = $request->getPost()->toArray();
                $file = $this->params()->fromFiles('foto');

                $data = array_merge(
                        $nonFile, //POST 
                        array('foto' => $file['name']) //FILE...
                );

                //chama o serviço de upload de imagens
                $upload = $this->getServiceLocator()->get('UploadImagem');

                //chama o metodo salvar informando o destino da imagem e o nome do arquivo
                $resultadoUpload = $upload->salvar($file);
           
                if ($resultadoUpload) {
                    
                    $service = $this->getServiceLocator()->get($this->service);
                    $insert = $service->insert($data);

                    if ($insert) {
                        
                        $this->flashMessenger()->addSuccessMessage('Registro salvo com sucesso!');
                    } else {
                        
                        $this->flashMessenger()->addErrorMessage('Não foi possível salvar o registro!');
                    }
                } else {

                    $this->flashMessenger()->addErrorMessage($resultadoUpload);
                }
            
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        } 

        return new ViewModel(array('form' => $form));
    }

    public function editAction() {

        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);

        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $array = $entity->toArray();
            unset($array['password']);
            $form->setData($array);
        }
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $update = $service->update($request->getPost()->toArray());

                if ($update) {
                    $this->flashMessenger()->addSuccessMessage('Registro alterado com sucesso!');
                } else {
                    $this->flashMessenger()->addErrorMessage('Não foi possível alterar o registro!');
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }


        return new ViewModel(array('form' => $form));
    }

    public function detailsAction() {

        $repository = $this->getEm()->getRepository($this->entity);

        $dados = $repository->find($this->params()->fromRoute('id', 0));

        return new ViewModel(array('data' => $dados));
    }

    public function filtroAction() {
        
        $request = $this->getRequest();

        if ($request->isPost()) {

            $filtro = $request->getPost()->toArray();

            $repo = $this->getEm()
                    ->getRepository($this->entity);
                    
            $list = $repo->createQueryBuilder('u')
                     ->where('u.nome LIKE :nome')
                     ->setParameter('nome', '%'.$filtro[busca].'%')
                     ->getQuery()
                     ->execute();    
            
            $page = $this->params()->fromRoute('page');

            $paginator = new Paginator(new ArrayAdapter($list));
            $paginator->setCurrentPageNumber($page);
            $paginator->setDefaultItemCountPerPage(20);

            return new ViewModel(array('data' => $paginator, 'page' => $page)); 
        }
    }

}
