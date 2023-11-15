<?php

include_once "class.dentista.php";
include_once "class.tratamento.php";

class DentistaParceiro extends Dentista
{

	// especilidades_porcentagem sera um dicionario com a chave sendo o nome da especialidade e o valor sendo a porcentagem
	private $especialidades_porcentagem = [];
	// a chave desse dicionario vai ser no formato : janeiro2023, fevereiro2024
	private $salario_mes_ano = [];

	public function __construct(string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidades, Usuario $usuario)
	{
		parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidades, $usuario);
	}

	// incrementa o valor se ja existir uma chave do mes, se nao existir vai criar
	public function incrementaSalario($anoMes, $valor)
	{
		if (array_key_exists($anoMes, $this->salario_mes_ano)) {
			$this->salario_mes_ano[$anoMes] += $valor;
		} else {
			$this->salario_mes_ano[$anoMes] = $valor;
		}
	}

	public function getSalarioAnoMes($anoMes)
	{
		if (array_key_exists($anoMes, $this->salario_mes_ano)) {
			return $this->salario_mes_ano[$anoMes];
		} else {
			return "Salário referente ao ano e mês não encontrado.";
		}
	}

	public function calculaValorProcedimento(Procedimento $procedimento)
	{
		$especialidade_para_procurar = null;
		$porcentagem_para_procedimento = 0;

		// devemos achar qual é a especialidade que o procedimento faz parte
		foreach ($this->especialidades as $especialidade) {
			if (in_array($procedimento, $especialidade->getProcedimentosPermitidos(), true)) {
				$especialidade_para_procurar = $especialidade;
				echo "Procedimento  " . $procedimento->getNome() . "  pertence a especialidade: " . $especialidade_para_procurar->getNomeEspecialidade();
			}
		}

		if ($especialidade_para_procurar == null) {
			echo "Procedimento " . $procedimento->getNome() . " não está nas especialidades do dentista.";
			return;
		}

		// procura no dicionario qual a porcentagem de determinada especialidade
		$porcentagem_para_procedimento = $this->especialidades_porcentagem[$especialidade_para_procurar->getNomeEspecialidade()];
		echo ($procedimento->getValor() * $porcentagem_para_procedimento);
		return ($procedimento->getValor() * $porcentagem_para_procedimento);
	}

	public function setPorcentagemEspecialidade($especialidade, $porcentagem)
	{
		$this->especialidades_porcentagem[$especialidade->getNomeEspecialidade()] = $porcentagem;
	}
}
