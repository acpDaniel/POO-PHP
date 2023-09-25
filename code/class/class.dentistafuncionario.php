<?php
   
	include_once "class.dentista.php";
    
	class DentistaFuncionario extends Dentista {
		private float $salario;

		public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, string $cro, string $especialidade, float $salario) {
			parent::__construct($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade, $salario);
			$this->salario = $salario;
		}
		
		public function getSalario() {
			return $this->salario;
		}
	}
?>