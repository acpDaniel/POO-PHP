<?php

include_once "class.dentista.php";
include_once "class.tratamento.php";

class DentistaParceiro extends Dentista
{

	// especilidades_porcentagem sera um dicionario com a chave sendo o nome da especialidade e o valor sendo a porcentagem
	private $especialidades_porcentagem = [];
	// a chave desse dicionario vai ser no formato : janeiro2023, fevereiro2024
	private $salario_mes_ano = [];

	static $local_filename = "dentistas_parceiro.txt";

	public function __construct(string $nome, string $email, string $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidades, Usuario $usuario, $especialidades_porcentagem)
	{
		parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidades, $usuario);
		$this->especialidades_porcentagem = $especialidades_porcentagem;
	}

	// incrementa o valor se ja existir uma chave do mes, se nao existir vai criar
	public function incrementaSalario($mesAno, $valor)
	{
		if (array_key_exists($mesAno, $this->salario_mes_ano)) {
			$this->salario_mes_ano[$mesAno] += $valor;
		} else {
			$this->salario_mes_ano[$mesAno] = $valor;
		}
	}

	public function getSalarioMesAno($mesAno)
	{
		if (array_key_exists($mesAno, $this->salario_mes_ano)) {
			return $this->salario_mes_ano[$mesAno];
		} else {
			return "Salário referente ao ano e mês não encontrado.";
		}
	}

	public function calculaValorProcedimento(Procedimento $procedimento, $porcentagem_realizada_pagamento)
	{
		$especialidade_para_procurar = null;
		$porcentagem_para_procedimento = 0;

		// devemos achar qual é a especialidade que o procedimento faz parte
		foreach ($this->especialidades as $especialidade) {
			if (in_array($procedimento, $especialidade->getProcedimentosPermitidos()) == true) {
				$especialidade_para_procurar = $especialidade;
				//echo "<Br>";
				//echo "Procedimento  " . $procedimento->getNome() . "  pertence a especialidade: " . $especialidade_para_procurar->getNomeEspecialidade();
				//echo "<Br>";
			}
		}

		if ($especialidade_para_procurar == null) {
			echo "Procedimento " . $procedimento->getNome() . " não está nas especialidades do dentista.";
			echo "<Br>";
			return;
		}

		// procura no dicionario qual a porcentagem de determinada especialidade
		$porcentagem_para_procedimento = $this->especialidades_porcentagem[$especialidade_para_procurar->getNomeEspecialidade()];
		return ($procedimento->getValor() * $porcentagem_para_procedimento * $porcentagem_realizada_pagamento);
	}

	public function getPorcentagemEspecialidade(string $nome_especialidade)
	{
		return $this->especialidades_porcentagem[$nome_especialidade];
	}

	public function setPorcentagemEspecialidade(string $nome_especialidade, $porcentagem)
	{
		$this->especialidades_porcentagem[$nome_especialidade] = $porcentagem;
	}
}
