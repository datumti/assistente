<?php

namespace Assistente\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;    

class Login extends Form {
    
    protected $departamentos;

    public function __construct($name = null) {
        parent::__construct('login');

        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new UsuarioFilter);

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
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Login',
                'class' => 'btn btn-primary btn-lg btn-block'
            )
        ));
    }

}
