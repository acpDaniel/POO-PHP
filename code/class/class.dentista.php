<?php
include_once "class.profissional.php";
include_once "class.especialidade.php";
class Dentista extends Profissional
{
    protected  $cro;
    protected $especialidades = array();

    public function __construct(string $nome, string $email, string $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidades)
    {
        parent::__construct($nome, $email, $telefone, $cpf, $endereco);
        $this->cro = $cro;
        $this->especialidades = $especialidades;
    }

    public function getCro()
    {
        return $this->cro;
    }
    public function getEspecialidades()
    {
        return $this->especialidades;
    }

    public function setCro($cro)
    {
        $this->cro =  $cro;
    }
    public function setEspecialidade($especialidade)
    {
        $this->especialidades = $especialidade;
    }

    public function adicionaEspecialidade(Especialidade $especialidade)
    {
        array_push($this->especialidades, $especialidade);
    }
}
