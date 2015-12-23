<?php

namespace Assistente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $em->getRepository('Assistente\Entity\Departamento');
        
        $departamentos = $repo->findAll();
        
        return new ViewModel(array('departamentos' => $departamentos));
    }
}
