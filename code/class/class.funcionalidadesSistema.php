<?php
require_once("persist.php");
require_once("class.profissional.php");
require_once("class.tratamento.php");
class FuncionalidadesSistema extends persist
{
    private $nomes_todas_funcionalidades = ["cadastroProcedimento", "cadastroEspecialidade", "cadastroPagamentoDoTratamento"];
    private $imposto_da_clinica = 0.2;
    static $local_filename = "funcionalidades.txt";

    public function __construct()
    {
    }

    public function adicionaFuncionalidade($nome_funcionalidade)
    {
        $this->nomes_todas_funcionalidades[] = $nome_funcionalidade;
    }

    public function getImpostoDaClinica()
    {
        return $this->imposto_da_clinica;
    }

    public function validaPermissao($nome_funcionalidade, Profissional $profissional_logado)
    {
        // array de funcionalidades permitidas obtida do perfil do profissional
        $funcionalidades_permitidas_usuario_logado = $profissional_logado->getUsuario()->getPerfil()->getFuncionalidadesPermitidas();

        // verificar que a funcionalidade é permitida para o usuario e que existe na classe funcionalidades
        if (in_array($nome_funcionalidade, $funcionalidades_permitidas_usuario_logado) && in_array($nome_funcionalidade, $this->nomes_todas_funcionalidades)) {
            return true;
        } else {
            return false;
        }
    }

    public function calculaResultadoMensal(Datetime $data_inicio_mes, Datetime $data_final_mes)
    {
        // valida se as datas sao do mesmo ano e mes
        if (!($data_inicio_mes->format('Y-m') === $data_final_mes->format('Y-m'))) {
            echo 'As datas não correspondem ao mesmo ano e mês.';
            return;
        }

        // pegar o mesAno em portugues
        setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese');
        $mesAno = strftime('%B', $data_inicio_mes->getTimestamp()) . $data_inicio_mes->format('Y');

        $lista_tratamentos = Tratamento::getRecords();
        $receita_total_tratamentos_mes = 0;
        // pegar a receita dos pagamentos que foram feitos naquele mes
        foreach ($lista_tratamentos as $tratamento) {
            $receita_total_tratamentos_mes += $tratamento->caculaReceita($data_inicio_mes, $data_final_mes);
        }

        // pegar despesas com dentistas parceiro
        $lista_dentistas_parceiro = DentistaParceiro::getRecords();
        $salario_total_dentistas_parceiro_mes = 0;
        foreach ($lista_dentistas_parceiro as $dentista_parceiro) {
            $salario_total_dentistas_parceiro_mes += $dentista_parceiro->getSalarioMesAno($mesAno);
        }

        // pegar despesas com dentistas funcionario
        $lista_dentistas_funcionario = DentistaFuncionario::getRecords();
        $salario_total_dentistas_funcionario_mes = 0;
        foreach ($lista_dentistas_funcionario as $dentista_funcionario) {
            $salario_total_dentistas_funcionario_mes += $dentista_funcionario->getSalario();
        }

        return ($receita_total_tratamentos_mes - $salario_total_dentistas_parceiro_mes - $salario_total_dentistas_funcionario_mes);
    }

    public function cadastrarProcedimento($profissional_logado, $nome, $valor, $descricao)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novaProcedimento = new Procedimento($nome, $valor, $descricao);
        $novaProcedimento->save();
    }

    public function cadastrarPagamentoDoTratamento($profissional_logado, $id, $forma_pagamento, $valor_total_pagamento,  $data_pagamento, $taxa_imposto)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novo_pagamento = new Pagamento($forma_pagamento, $valor_total_pagamento,  $data_pagamento, $taxa_imposto);
        $lista_tratamentos_possiveis = Tratamento::getRecords();
        $objeto_alvo_modificacao = null;
        // encontrar o tratamento que devemos alterar
        foreach ($lista_tratamentos_possiveis as $tratamento_possivel) {
            if ($tratamento_possivel->getId() == $id) {
                $objeto_alvo_modificacao = $tratamento_possivel;
            }
        }
        $objeto_alvo_modificacao->adiconaPagamentoEfetuado($novo_pagamento);
        $objeto_alvo_modificacao->save();
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
