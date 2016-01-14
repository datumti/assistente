<?php

namespace Assistente\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select,
    Zend\Form\Element\Checkbox;    

class Usuario extends Form {
    
    protected $departamentos;

    public function __construct($name = null, array $departamentos = null) {
        parent::__construct('usuario');
        $this->departamentos = $departamentos;

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new UsuarioFilter); 
        $this->setAttribute('enctype','multipart/form-data');   

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));
        
        $this->add(array(
            'name' => 'matricula',
            'options' => array(
                'type' => 'text',
                
            ),
            'attributes' => array(
                'id' => 'matricula',
                'placeholder' => 'Número da matricula',
                'class' => 'form-control input-lg'
            )
        ));
        
        $this->add(array(
            'name' => 'admissao',
            'options' => array(
                'type' => 'text',
                
            ),
            'attributes' => array(
                'id' => 'admissao',
                'placeholder' => 'Data de Admissao',
                'class' => 'form-control input-lg'
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
        
        $departamento = new Select();
        $departamento->setName('departamento')
                     ->setOptions(array(
                         'empty_option' => 'Departamento do usuario',
                         'value_options' => $this->departamentos))
                     ->setAttributes(array(
                             'class' => 'form-control input-lg'
                         )
                      );
        $this->add($departamento);

        $this->add(array(
            'name' => 'foto',
            'attributes' => array(
                'type' => 'file',
                'id' => 'foto',
                
            )
        ));

        $this->add(array(
            'name' => 'dataNascimento',
            'options' => array(
                'type' => 'text',
                
            ),
            'attributes' => array(
                'id' => 'dataNascimento',
                'placeholder' => 'Data de Nascimento',
                'class' => 'form-control input-lg'
            )
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'type' => 'email',
                
            ),
            'attributes' => array(
                'id' => 'email',
                'placeholder' => 'E-mail',
                'class' => 'form-control input-lg'
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'options' => array(
                'type' => 'Password',
                
            ),
            'attributes' => array(
                'id' => 'password',
                'placeholder' => 'Senha',
                'class' => 'form-control input-lg',
                'type' => 'password'
            )
        ));
        
        $status = new Select();
        $status->setName('status')
                     ->setOptions(array(
                         'empty_option' => 'Tipo de Usuario',
                         'value_options' => array(
                             '0' => 'Administrador', 
                             '1' => 'Colaborador', 
                             '2' => 'Visitante')))
                     ->setAttributes(array(
                             'class' => 'form-control input-lg'
                         )
                      );
                     
        $this->add($status);
        
        
        /*$ativo = new \Zend\Form\Element\Checkbox("ativo");
        $ativo->setLabel("Desativar?: ");
        $ativo->setCheckedValue("0");
        $this->add($ativo);*/
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'ativo',
            'options' => array(
                'label' => 'Desativar?:',
                'use_hidden_element' => true,
                'checked_value' => 0,
                'unchecked_value' => 1
            ),
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
