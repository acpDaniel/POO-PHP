<?php

include_once "class.profissional.php";

class Auxiliar extends Profissional
{
    private float $salario;

    public function __construct(string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, float $salario)
    {
        parent::__construct($nome, $email, $telefone, $cpf, $endereco);
        $this->salario = $salario;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
    }
}
