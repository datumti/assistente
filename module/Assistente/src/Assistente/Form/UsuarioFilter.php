<?php

namespace Assistente\Form;

use Zend\InputFilter\InputFilter;


class UsuarioFilter extends InputFilter {
  
    public function __construct() {
        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo nome não pode estar em branco'),
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'dataNascimento',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo data de nascimento não pode estar em branco'),
                    )
                )
            )
        ));
        
         $this->add(array(
            'name' => 'admissao',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo data da admissão não pode estar em branco'),
                    )
                )
            )
        ));
         
          $this->add(array(
            'name' => 'matricula',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo matricula não pode estar em branco'),
                    )
                )
            )
        ));
        
         $this->add(array(
            'name' => 'departamento',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo departamento não pode estar em branco'),
                    )
                )
            )
        ));
         
         $this->add(array(
            'name' => 'status', 
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo status não pode estar em branco'),
                    )
                )
            )
        )); 
    }
  
}
