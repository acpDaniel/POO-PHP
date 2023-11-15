<?php

include_once "class.dentista.php";

class DentistaFuncionario extends Dentista
{
	private float $salario_fixo;

	public function __construct(string $nome, string $email, string $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidade, float $salario, Usuario $usuario)
	{
		parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade, $usuario);
		$this->salario_fixo = $salario;
	}

	public function getSalario()
	{
		return $this->salario_fixo;
	}

	protected function setSalario($salario)
	{
		$this->salario_fixo = $salario;
	}
}
