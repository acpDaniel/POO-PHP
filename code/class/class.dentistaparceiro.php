<?php
   
	include_once "class.dentista.php";
	include_once"class.tratamento.php";
	
	class DentistaParceiro extends Dentista {
		private float $porcentagem;
		private array $tratamentos = array(); 
		private float $salario;

		public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, string $cro, array $especialidade, float $porcentagem) {
			parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade);
			$this->porcentagem = $porcentagem;
		}

		public function getPorcentagem() {
			return $this->porcentagem;
		}

		public function getTratamentos() {
			return $this->tratamentos;
		}

		public function addTratamento(Tratamento $tratamento){
			$this->tratamentos[] = $tratamento;
		}

		// pega o valor de cada tratamento e soma
		// (tem q transformar pra tratamento depois, mas to com preguiça de fazer a classe tratamentos agora)
		public function getSalario() {
			$this->salario = 0;
			if (count($this->tratamentos) != null) { // se tiver algo nos tratamentos ele irá fazer o calculo, se não, é 0
				for ($i = 0; $i < count($this->tratamentos); $i++) {
					$this->salario += this->$porcentagem*$this->tratamentos[$i]->getValor();
				}
			}
			return $this->salario;
		}
	}
?>
