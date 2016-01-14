<?php

namespace Assistente\Form;

use Zend\InputFilter\InputFilter;


class DepartamentoFilter extends InputFilter {
    
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
        
       /* $this->add(array(
            'name' => 'sigla',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'O campo sigla não pode estar em branco'),
                    )
                )
            )
        ));*/
    }
    
}
