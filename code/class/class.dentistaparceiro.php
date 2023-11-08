<?php

include_once "class.dentista.php";
include_once "class.tratamento.php";

class DentistaParceiro extends Dentista
{

	private $especialidades_porcentagem = [];
	// a chave desse dicionario vai ser no formato : janeiro2023, fevereiro2024
	private $salario_mes_ano = [];

	public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, string $cro, array $especialidade, float $porcentagem)
	{
		parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade);
	}

	// incrementa o valor se ja existir uma chave do mes, se nao existir vai criar
	public function incrementaSalario($data, $valor)
	{
		if (array_key_exists($data, $this->salario_mes_ano)) {
			$this->salario_mes_ano[$data] += $valor;
		} else {
			$this->salario_mes_ano[$data] = $valor;
		}
	}

	public function getSalarioMes($mes)
	{
		if (array_key_exists($mes, $this->salario_mes_ano)) {
			return $this->salario_mes_ano[$mes];
		} else {
			return "Mês não encontrado";
		}
	}

	public function calculaValorProcedimento(Procedimento $procedimento)
	{
		$especialidade_para_procurar = null;
		$porcentagem_para_procedimento = 0;

		// devemos achar qual é a especialidade que o procedimento faz parte
		foreach ($this->especialidades as $especialidade) {
			if (in_array($procedimento, $especialidade->procedimentos_permitidos, true)) {
				$especialidade_para_procurar = $especialidade;
			}
		}

		$porcentagem_para_procedimento = $this->especialidades_porcentagem[$especialidade];

		return ($procedimento->getValor() * $porcentagem_para_procedimento);
	}

	public function setPorcentagemEspecialidade($especialidade, $porcentagem)
	{
		$this->especialidades_porcentagem[$especialidade] = $porcentagem;
	}
}
