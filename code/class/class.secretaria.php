<?php
include_once "class.secretaria.php";
class Secretaria extends Profissional
{
    private float $salario;

    public function __construct(string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, float $salario, Usuario $usuario)
    {
        parent::__construct($nome, $email, $telefone, $cpf, $endereco, $usuario);
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
