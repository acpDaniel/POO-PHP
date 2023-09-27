<?php
class Procedimento {
    private string $nome;
    private float $valor;
    private string $descricao;

    public function __construct(string $nome, float $valor, string $descricao) {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->descricao = $descricao;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getDescricao() {
        return $this->descricao;
    }
}
?>