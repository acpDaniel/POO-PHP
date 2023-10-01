<?php
include_once "class.pessoa.php";
class Profissional extends Pessoa {
    protected string $cpf;
    protected string $endereco;

    public function __construct(string $nome, string $email, int $telefone, string $cpf, string $endereco) {
        parent::__construct($nome, $email, $telefone);
        $this->cpf = $cpf;
        $this->endereco = $endereco;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
}
?>
