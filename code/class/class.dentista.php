<?php
include_once "class.includes.php";
class Dentista extends Profissional{
    protected string $cro;
    protected string $especialidade;
    
    public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, string $cro, string $especialidade) {
        parent::__construct($nome, $email, $telefone, $cpf, $endereco);
        $this->cro = $cro;
        $this->especialidade = $especialidade;
    }
    
    public function getCro(){
        return $this->cro;
    }
    public function getEspecialidade(){
        return $this->especialidade;
    }

    public function setCro($cro){
        $this->cro =  $cro;
    }
    public function setEspecialidade($especialidade){
        $this->especialidade = $especialidade;
    }
}
?>
