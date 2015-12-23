<?php

namespace Assistente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="departamentos")
 * @ORM\Entity(repositoryClass="Assistente\Entity\DepartamentoRepository")
 */
class Departamento {
    
    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->usuarios = new ArrayCollection();
    }

        /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $nome;
    
     /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $sigla;
    
    public function getId() {
        return $this->id;
    }
 
    public function getNome() {
        return $this->nome;
    }
    
    public function getSigla() {
        return $this->sigla;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    
    public function setSigla($sigla) {
        $this->sigla = $sigla;
        return $this;
    }
    
     public function __toString() {
        return $this->nome;
    }
    
    public function toArray(){
        return array(
            'id' => $this->getId(), 
            'nome' => $this->getNome(),
            'sigla' => $this->getSigla() 
            );
    }


    
}
