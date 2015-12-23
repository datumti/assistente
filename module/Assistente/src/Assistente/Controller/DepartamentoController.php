<?php

namespace Assistente\Controller;

class DepartamentoController extends CrudController {

    public function __construct() {
        $this->entity = "Assistente\Entity\Departamento";
        $this->form = "Assistente\Form\Departamento";
        $this->service = "Assistente\Service\Departamento";
        $this->controller = "departamentos";
        $this->route = "assistente";
        
    }

}
