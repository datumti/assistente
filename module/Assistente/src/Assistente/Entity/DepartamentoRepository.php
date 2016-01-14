<?php

namespace Assistente\Entity;

use Doctrine\ORM\EntityRepository;

class DepartamentoRepository extends EntityRepository {

    public function fetchPairs() {
        $entities = $this->findBy(array(), array('nome' => 'asc'));

        $array = array();

        foreach ($entities as $entity) { 
            $array[$entity->getId()] = ucfirst(strtolower($entity->getNome()));
        }

        return $array;
    }

}
