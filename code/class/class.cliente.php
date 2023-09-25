<?php
 
	include_once("class.cliente.php")
	class Cliente {
    // Atributos protegidos
    private $rg;
    private $cpf;
    private $lista_pacientes;

    // Construtor
    public function __construct($rg, $cpf) {
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->lista_pacientes = array();
    }

    // Métodos para obter os atributos
    public function getRg() {
        return $this->rg;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getListaPacientes() {
        return $this->lista_pacientes;
    }

    // Métodos para definir os atributos
    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setListaPacientes($lista_pacientes) {
        $this->lista_pacientes = $lista_pacientes;
    }
}

?>