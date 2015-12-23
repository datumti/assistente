<?php


namespace Assistente\Service;

use Doctrine\ORM\EntityManager;
use Assistente\Entity\Configurator;


class Usuarios extends AbstractService {
    
    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = "Assistente\Entity\Usuario";
    }
    
    public function insert(array $data){
        
        $entity = new $this->entity($data);
        
        if(empty($data['password']))
            unset($data['password']);
        
        $entity = Configurator::configure($entity, $data);
        
        $departamento = $this->em->getReference("Assistente\Entity\Departamento", $data['departamento']);
        $entity->setDepartamento($departamento);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
    public function update(array $data){
        $entity = $this->em->getReference($this->entity, $data['id']);
        
        if(empty($data['password']))
            unset($data['password']);
        
        $entity = Configurator::configure($entity, $data);
        
        $departamento = $this->em->getReference("Assistente\Entity\Departamento", $data['departamento']); 
        $entity->setDepartamento($departamento);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
   
}
