<?php

namespace Assistente\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {

    public function findByEmailAndPassword($email, $password) {

        $user = $this->findOneByEmail($email);
        if ($user) {
            $hashSenha = $user->encryptPassword($password);

            if ($hashSenha == $user->getPassword()) {

                if($user->getStatus() == '0') {

                    $resultado = array();

                    $resultado['id'] = $user->getId();
                    $resultado['nome'] = $user->getNome();
                    $resultado['matricula'] = $user->getMatricula();
                    $resultado['foto'] = $user->getFoto();
                    $resultado['dataNascimento'] = $user->getDataNascimento();
                    $resultado['email'] = $user->getEmail();
                    $resultado['status'] = $user->getStatus();
                    
                } else {
                    $resultado = false;
                }

                return $resultado;
            } else
                return false;
        } else
            return false;
    }

}
