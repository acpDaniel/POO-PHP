<?php
    include_once "class.profissional.php";
    class Dentista extends Profissional{
        protected string $cro;
        protected array $especialidade;
        
        public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco, string $cro, array $especialidade) {
            parent::__construct($nome, $email, $telefone, $cpf, $endereco);
            $this->cro = $cro;
            $this->especialidade = $especialidade;
        }
        
        public function getCro(){
            return $this->cro;
        }
        public function getEspecialidade(){
            return $this->especialidade;
        }

        public function setCro($cro){
            $this->cro =  $cro;
        }
        public function setEspecialidade($especialidade){
            $this->especialidade = $especialidade;
        }
    }
?>
