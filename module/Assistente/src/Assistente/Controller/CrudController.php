<?php

namespace Assistente\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

abstract class CrudController extends AbstractActionController {

    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $route;
    protected $controller;

    public function indexAction() {
         
        $list = $this->getEm()
                ->getRepository($this->entity)
                ->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(5);

        return new ViewModel(array('data' => $paginator, 'page' => $page));
    }

    public function newAction() {
        $form = new $this->form();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $insert = $service->insert($request->getPost()->toArray());

                if ($insert) {
                    $this->flashMessenger()->addSuccessMessage('Registro salvo com sucesso!');
                } else {
                    $this->flashMessenger()->addErrorMessage('Não foi possível salvar o registro!');
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));
    }

    public function editAction() {

        $form = new $this->form();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);

        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $update  = $service->update($request->getPost()->toArray());

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

    public function deleteAction() {

        $service = $this->getServiceLocator()->get($this->service);
        $delete = $service->delete($this->params()->fromRoute('id', 0));

        if ($delete) {
            $this->flashMessenger()->addSuccessMessage('Registro removido com sucesso!');
        } else {
            $this->flashMessenger()->addErrorMessage('Não foi possível salvar o registro!');
        }

        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
    }

    protected function getEm() {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }

}
