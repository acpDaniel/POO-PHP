<?php

// importa a classe mãe da herança "pessoa"
include_once "class.pessoa.php";
include_once "class.paciente.php";
include_once "class.orcamento.php";
include_once "class.tratamento.php";

class Cliente extends Pessoa
{
    protected string $rg;
    protected string $cpf;
    protected array $pacientes;
    static $local_filename = "clientes.txt";

    public function __construct(string $nome, string $email, int $telefone, string $rg, string $cpf)
    {
        parent::__construct($nome, $email, $telefone);
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->pacientes = array();
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getPacientes()
    {
        return $this->pacientes;
    }

    // retorna um Paciente especifico do array dos pacientes, $i é a posição na lista
    public function getPaciente(int $i)
    {
        $paciente = $this->getPacientes();
        return $paciente[$i];
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setPacientes(array $pacientes)
    {
        $this->pacientes = $pacientes;
    }

    public function adicionaPaciente(Paciente $novopaciente)
    {
        array_push($this->pacientes, $novopaciente);
    }
}
