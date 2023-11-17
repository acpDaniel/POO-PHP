<?php
require_once("persist.php");
require_once("class.profissional.php");
require_once("class.tratamento.php");
class Funcionalidades extends persist
{
    private $nomes_todas_funcionalidades = ["cadastroProcedimento", "cadastroEspecialidade", "cadastroPagamentoDoTratamento"];
    static $local_filename = "funcionalidades.txt";

    public function adicionaFuncionalidade($nome_funcionalidade)
    {
        $this->nomes_todas_funcionalidades[] = $nome_funcionalidade;
    }
    public function executaFuncionalidade($nome_funcionalidade, Profissional $profissional_logado, $objeto_referencia, $objeto_opcional_mudanca = "")
    {
        if ($this->validaPermissao($nome_funcionalidade, $profissional_logado) == true) {
            switch ($nome_funcionalidade) {
                case "cadastroProcedimento":
                    $this->cadastroProcedimento($objeto_referencia);
                    break;
                case "cadastroEspecialidade":
                    $this->cadastroEspecialidade($objeto_referencia);
                    break;
                case "cadastroPagamentoDoTratamento":
                    $this->cadastroPagamentoDoTratamento($objeto_referencia, $objeto_opcional_mudanca);
                    break;
            }
        } else {
            echo "Você não possui permissão para executar a funcionalidade :" . $nome_funcionalidade;
        }
    }

    public function validaPermissao($nome_funcionalidade, Profissional $profissional_logado)
    {
        // array de funcionalidades permitidas obtida do perfil do profissional
        $funcionalidades_permitidas_usuario_logado = $profissional_logado->getUsuario()->getPerfil()->getFuncionalidadesPermitidas();

        // verificar que a funcionalidade é permitida para o usuario e que existe na classe funcionalidades
        if (in_array($funcionalidades_permitidas_usuario_logado, $nome_funcionalidade) && in_array($this->nomes_todas_funcionalidades, $nome_funcionalidade)) {
            return true;
        } else {
            return false;
        }
    }

    public function cadastroProcedimento($objeto)
    {
        $objeto->save();
    }

    public function cadastroEspecialidade($objeto)
    {
        $objeto->save();
    }

    public function cadastroPagamentoDoTratamento($objeto_referencia, $objeto_mudanca)
    {
        $lista_tratamentos_possiveis = Tratamento::getRecords();
        $objeto_alvo_modificacao = null;
        // encontrar o tratamento que devemos alterar
        foreach ($lista_tratamentos_possiveis as $tratamento_possivel) {
            if ($tratamento_possivel->getDataOrcamento() === $objeto_referencia->getDataOrcamento() &&  $tratamento_possivel->getPaciente() === $objeto_referencia->getPaciente()) {
                $objeto_alvo_modificacao = $tratamento_possivel;
            }
        }
        $objeto_alvo_modificacao->adiconaPagamentoEfetuado($objeto_mudanca);
        $objeto_alvo_modificacao->save();
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
