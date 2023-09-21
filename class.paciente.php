<?php
include_once("class.pessoa.php");

class Paciente extends Pessoa {
    protected $rg;
    protected $nascimento;
    protected $responsavel;

    public function __construct(string $rg, string $nascimento, $responsavel) {
        parent::__construct();
        $this->rg = $rg;
        $this->nascimento = $nascimento;
        $this->responsavel = $responsavel;
    }

    public function getRg() {
        return $this->rg;
    }
    public function getNascimento() {
        return $this->nascimento;
    }
    public function getResponsavel() {
        return $this->responsavel;
    }

    public function setRg(string $rg) {
        $this->rg = $rg;
    }
    public function setNascimento(string $nascimento) {
        $this->nascimento = $nascimento;
    }
    public function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }
}
?>