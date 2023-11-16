<?php
require_once("persist.php");
class Endereco extends persist
{
    private $rua;
    private $bairro;
    private $numero;
    private $cep;
    private $cidade;
    private $estado;
    private $complemento;
    static $local_filename = "enderecos.txt";

    public function __construct($rua, $bairro, $numero, $cep, $cidade, $estado, $complemento)
    {
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->complemento = $complemento;
    }

    // Métodos getters
    public function getRua()
    {
        return $this->rua;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    // Métodos setters
    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
