<?php

include_once "class.consulta.php";

class ConsultaExecucao extends Consulta
{
    static $local_filename = "consultas_execucao.txt";

    public function __construct($dentista_executor, Datetime $dataehorario, $duracao_consulta, $procedimento)
    {
        if ($this->validaDentistaExecutor($dentista_executor, $procedimento) === false) {
            throw new InvalidArgumentException("O dentista não tem permissão para realizar esse procedimento. ");
        } else {
            parent::__construct($dentista_executor, $dataehorario, $duracao_consulta);
        }
    }

    public function validaDentistaExecutor($dentista_executor, $procedimento)
    {
        $permissaoDentista = false;
        // validar em todas especialidades do dentista se tem o procedimento permitido
        foreach ($dentista_executor->getEspecialidades() as $especialidade) {
            if (in_array($procedimento, $especialidade->getProcedimentosPermitidos()) == true) {
                $permissaoDentista = true;
            }
        }
        return $permissaoDentista;
    }
}
