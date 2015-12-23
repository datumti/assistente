<?php

namespace Assistente\Form;

use Zend\Form\Form;

class Departamento extends Form {
    
    public function __construct($name = null) {
        parent::__construct('departamento');
        
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new DepartamentoFilter);
        
        $this->add(array(
           'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));
        
        $this->add(array(
           'name' => 'nome',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'nome',
                'placeholder' => 'Nome',
                'class' => 'form-control input-lg'
            )
        ));
        
        $this->add(array(
           'name' => 'sigla',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'sigla',
                'placeholder' => 'Sigla',
                'class' => 'form-control input-lg'
            )
        ));
        
        $this->add(array(
           'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));
    }
    
}
