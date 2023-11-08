<?php
class ConsultaExecucao extends Consulta
{

    public function __construct($dentista_executor, $data, $horario, $duracao_consulta)
    {
        parent::__construct($dentista_executor, $data, $horario, $duracao_consulta);
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
