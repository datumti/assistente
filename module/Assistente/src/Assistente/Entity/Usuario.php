<?php


namespace Assistente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="Assistente\Entity\UsuarioRepository")
 */
class Usuario {
    
   
       /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
     /**
     * @ORM\OneToOne(targetEntity="Assistente\Entity\Departamento")
     * @ORM\JoinColumn(name="departamentoId", referencedColumnName="id")
     */
    protected $departamento;

    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $matricula;
    
     /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $admissao;
    
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $foto;
    
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $dataNascimento;
    
    /**
     * @ORM\Column(type="integer")
     * @var int 
     */
    protected $status;
    
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $email;
    
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $password;
    
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $salt;
    
     /**
     * @ORM\Column(type="integer")
     * @var int 
     */
    protected $ativo;
   
    
    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->salt = base_convert(sha1(uniqid(mt_rand(),true)), 16, 36);
    }
    
    
    public function getId() {
        return $this->id;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getDataNascimento() {
        
         $d=explode("-",$this->dataNascimento);
         $data=$d[2]."/".$d[1]."/".$d[0];
        
        return $data;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getEmail() {
        return $this->email;
    }
    
     public function getSalt() { 
        return  $this->salt;
    }

    public function getPassword() {
        return $this->password;
    }
    
     function getMatricula() {
        return $this->matricula;
    }

    function getAdmissao() {
        return $this->admissao;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }

    public function setDataNascimento($dataNascimento) {
        
        $d=explode("/",$dataNascimento);
        $data=$d[2]."-".$d[1]."-".$d[0];
        
        $this->dataNascimento = $data;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        
       $hashSenha = $this->encryptPassword($password);
       $this->password = $hashSenha;
       return $this;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }
    
    public function encryptPassword($password) {
        $hashSenha = hash('sha512', $password . $this->salt);
        for ($i = 0; $i < 64000; $i++)
            $hashSenha = hash('sha512', $hashSenha);
        
        return $hashSenha;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
        return $this;
    }

    function setAdmissao($admissao) {
        $this->admissao = $admissao;
        return $this;
    }
    
    function getAtivo() {
        return $this->ativo;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
        return $this;
    }

    
    
    public function toArray(){
        return array(
            'id' => $this->getId(), 
            'nome' => $this->getNome(),
            'matricula' => $this->getMatricula(),
            'admissao' => $this->getAdmissao(),
            'foto' => $this->getFoto(),
            'dataNascimento' => $this->getDataNascimento(),
            'status' => $this->getStatus(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'salt' => $this->salt,
            'departamento' => $this->departamento->getId(),
            'ativo' => $this->getAtivo()
            );
    }
    
}
