<?php

namespace Assistente\Controller;

use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class DepartamentoController extends CrudController {

    public function __construct() {
        $this->entity = "Assistente\Entity\Departamento";
        $this->form = "Assistente\Form\Departamento";
        $this->service = "Assistente\Service\Departamento";
        $this->controller = "departamentos";
        $this->route = "assistente";
        
    }
    
    public function filtroAction() {
        
        $request = $this->getRequest();

        if ($request->isPost()) {
            
            $filtro = $request->getPost()->toArray();

            $repo = $this->getEm()
                    ->getRepository($this->entity);
                    
            $list = $repo->createQueryBuilder('d')
                     ->where('d.nome LIKE :nome')
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
