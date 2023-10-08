<?php
   
	include_once "class.dentista.php";
	
	class DentistaParceiro extends Dentista {
		private float $porcentagem;
		private array $orcamentos = array(); // cria orcamentos como nulo
		private float $salario;

		public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, string $cro, array $especialidade, float $porcentagem) {
			parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade);
			$this->porcentagem = $porcentagem;
		}

		public function getPorcentagem() {
			return $this->porcentagem;
		}

		public function getOrcamentos() {
			return $this->orcamentos;
		}

		// pega o valor de cada orcamento e soma
		// (tem q transformar pra tratamento depois, mas to com preguiça de fazer a classe tratamentos agora)
		public function getSalario() {
			$this->salario = 0;
			if ($this->orcamentos != null) { // se tiver algo no orçamentos ele irá fazer o calculo, se não, é 0
				for ($i = 0; $i < count($this->orcamentos); $i++) {
					$this->salario += $this->orcamentos[$i]->getValor();
				}
			}
			return $this->salario;
		}
	}
?>