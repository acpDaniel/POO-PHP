<?php
   
	include_once("class.dentistaparceiro.php")
	class DentistaParceiro {
		// Atributos protegidos
		protected $cro;
		protected $especialidade;
		protected $porcentagem;
		protected $procedimentos;
		protected $salario;

		// Construtor
		public function __construct($cro, $especialidade, $porcentagem, $procedimentos, $salario) {
			$this->cro = $cro;
			$this->especialidade = $especialidade;
			$this->porcentagem = $porcentagem;
			$this->procedimentos = $procedimentos;
			$this->salario = $salario;
		}

		// Métodos para obter os atributos
		public function getCro() {
			return $this->cro;
		}

		public function getEspecialidade() {
			return $this->especialidade;
		}

		public function getPorcentagem() {
			return $this->porcentagem;
		}

		public function getProcedimentos() {
			return $this->procedimentos;
		}

		public function getSalario() {
			return $this->salario;
		}

		// Métodos para definir os atributos
		public function setCro($cro) {
			$this->cro = $cro;
		}

		public function setEspecialidade($especialidade) {
			$this->especialidade = $especialidade;
		}

		public function setPorcentagem($porcentagem) {
			$this->porcentagem = $porcentagem;
		}

		public function setProcedimentos($procedimentos) {
			$this->procedimentos = $procedimentos;
		}

		public function setSalario($salario) {
			$this->salario = $salario;
		}
	}

?>