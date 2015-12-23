<?php


namespace Assistente\Service;

use Doctrine\ORM\EntityManager;

class Departamentos extends AbstractService {
    
    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = "Assistente\Entity\Departamento";
    }
    
   
}
