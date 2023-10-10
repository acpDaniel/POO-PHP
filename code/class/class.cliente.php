<?php

    // importa a classe mãe da herança "pessoa"
    include_once "class.pessoa.php";
    include_once "class.paciente.php";
    include_once "class.orcamento.php";
    include_once "class.tratamento.php";

    class Cliente extends Pessoa {
        // Atributos protegidos
        protected string $rg;       
        protected string $cpf;
        protected array $pacientes;
        
        // Construtor
        public function __construct(string $nome, string $email, int $telefone, string $rg, string $cpf) {
            parent::__construct($nome, $email, $telefone);      // construtor da classe mãe Pessoa
            $this->rg = $rg;
            $this->cpf = $cpf;
            $this->pacientes = array();
        }

        // retorna o rg
        public function getRg() {
            return $this->rg;
        }

        // retorna o cpf
        public function getCpf() {
            return $this->cpf;
        }

        // retorna um array<Paciente>
        public function getPacientes() {
            return $this->pacientes;
        }

        // retorna um Paciente especifico do array dos pacientes, $i é a posição na lista
        public function getPaciente(int $i) {
            $paciente = $this->getPacientes();
            return $paciente[$i];
        }

        // define o rg
        public function setRg($rg) {
            $this->rg = $rg;
        }
        
        // define o cpf
        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }
        
        // cria um Paciente e o mesmo é retornado
        // É pensado em uma lógica que apenas o um cliente pode criar um paciente relacionado a ele
        public function criarPaciente(string $nome, string $email, int $telefone, string $rg, string $nascimento) : Paciente {
            $novopaciente = new Paciente ($nome, $email, $telefone, $rg, $nascimento, $this); // construtor do pacienete
            $this->addPacientes($novopaciente);         // adiciona o paciente criado a propria lista
            echo "Paciente " . $nome . " criado para " . $this->getNome() . "\n";
            return $novopaciente;
        }

        // define o array de pacientes
        public function setPacientes(array $pacientes) {
            $this->pacientes = $pacientes;
        }
        
        // adiciona um paciente a lista de Pacientes
        public function addPacientes(Paciente $novopaciente) {
            array_push($this->pacientes, $novopaciente);
        }
    }
?>