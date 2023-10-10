<?php
    // Código da classe Auxiliar

    // Importa a classe mãe da herança "profissional"
    include_once "class.profissional.php";

    // Classs Auxiliar
    class Auxiliar extends Profissional {
        private float $salario;  // salario mensal

        // construtor da classe
        public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, float $salario) {
            parent::__construct($nome, $email, $telefone, $cpf, $endereco); // construtor da classe mãe Profissional
            $this->salario = $salario;
        }
        
        // retorna o salario mensal
        public function getSalario(){
            return $this->salario;
        }

        // define um salario mensal
        public function setSalario($salario) {
            $this->salario = $salario;
        }
    }
?>
