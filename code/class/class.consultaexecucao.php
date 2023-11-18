<?php

include_once "class.consulta.php";

class ConsultaExecucao extends Consulta
{
    static $local_filename = "consultas_execucao.txt";

    public function __construct($dentista_executor, Datetime $dataehorario, $duracao_consulta, $procedimento)
    {
        if ($this->validaDentistaExecutor($dentista_executor, $procedimento) == false) {
            throw new InvalidArgumentException("O dentista não tem permissão para realizar essa consulta.");
        } else {
            parent::__construct($dentista_executor, $dataehorario, $duracao_consulta);
        }
    }

    public function validaDentistaExecutor($dentista_executor, $procedimento)
    {
        $permissaoDentista = false;
        // validar em todas especialidades do dentista se tem o procedimento permitido
        foreach ($dentista_executor->especialidades as $especialidade) {
            if (in_array($especialidade->procedimentos_permitidos, $procedimento, true)) {
                $permissaoDentista = true;
            }
        }

        return $permissaoDentista;
    }
}
