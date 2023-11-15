<?php

include_once "class.orcamento.php";
include_once "class.formaPagamento.php";
include_once "class.consultaExecucao.php";
include_once "class.pagamento.php";

class Tratamento extends Orcamento
{
    private FormaPagamento $forma_pagamento_proposto;
    private Datetime $data;
    public $infos_procedimentos = array();
    private $pagamentos_efetuados = array();

    public function __construct(FormaPagamento $forma_pagamento_proposto, Datetime $data, $paciente, $dentista_avaliador, $data_orcamento, $procedimentos)
    {

        parent::__construct($paciente, $dentista_avaliador, $data_orcamento, $procedimentos);
        foreach ($procedimentos as $procedimento) {
            $this->adicionaInfosProcedimento($procedimento);
        }
        $this->forma_pagamento_proposto = $forma_pagamento_proposto;
        $this->data = $data;
    }

    public function getFormaPagamento()
    {
        return $this->forma_pagamento_proposto;
    }

    public function getData()
    {
        return $this->data->format('d-m-Y');
    }

    public function setFormaPagamento($forma_pagamento)
    {
        $this->forma_pagamento_proposto = $forma_pagamento;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function validaInfosProcedimentoCadastradoExiste($procedimento)
    {
        $procedimento_existe = false;
        // validar se o procedimento em questao ja esta cadastrado como um infosProcedimento
        foreach ($this->infos_procedimentos as $infos_procedimento) {
            if ($infos_procedimento->getProcedimento() === $procedimento) {
                $procedimento_existe = true;
            }
        }
        return $procedimento_existe;
    }

    public function adicionaInfosProcedimento($procedimento)
    {
        // se nao tiver sido criado um infosProcedimento para certo procedimento temos que criar e adicionar no array da classe
        if ($this->validaInfosProcedimentoCadastradoExiste($procedimento) == false) {
            $novo_infos_procedimento = new InfosProcedimento($procedimento);
            array_push($this->infos_procedimentos, $novo_infos_procedimento);
        } else {
            echo "Já existe um cadastro com as informações desse procedimento";
        }
    }

    public function finalizaProcedimento($procedimento, Datetime $data_conclusao)
    {
        // para finalizar um procedimento valida se as infos dele estao cadastradas
        if ($this->validaInfosProcedimentoCadastradoExiste($procedimento) == false) {
            echo "Procedimento não cadastrado";
            return;
        } else {
            foreach ($this->infos_procedimentos as $infos_procedimento) {
                if ($infos_procedimento->getProcedimento() === $procedimento) {
                    $infos_procedimento->setStatus("Finalizado");
                    $infos_procedimento->setDataConclusao($data_conclusao);
                }
            }
        }
    }

    public function agendaConsulta($dentista, Datetime $data, $horario, $duracao_consulta, Procedimento $procedimento)
    {
        // garantir que existe o cadastro das informacoes do procedimento que se refere a consulta
        $this->adicionaInfosProcedimento($procedimento);

        // instancia uma consulta e adiciona o respectivo procedimento
        $nova_consulta = new ConsultaExecucao($dentista, $data, $horario, $duracao_consulta, $procedimento);
        foreach ($this->infos_procedimentos as $infos_procedimento) {
            if ($infos_procedimento->getProcedimento() === $procedimento) {
                $infos_procedimento->adicionaConsulta($nova_consulta);
            }
        }
    }

    public function adiconaPagamentoEfetuado(Pagamento $pagamento)
    {
        array_push($this->pagamentos_efetuados, $pagamento);
    }

    public function caculaValorFaturado($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final)
    {
        $data_inicio = new DateTime("$ano_inicial-$mes_inicial-$dia_inicial");
        $data_fim = new DateTime("$ano_final-$mes_final-$dia_final");

        $pagamentos_data_filtrada = [];
        $valor_faturado_total = 0;

        // filtrar os pagamentos que estão entre as datas desejadas
        foreach ($this->pagamentos_efetuados as $pagamento) {
            if ($pagamento->getDataPagamento() >= $data_inicio && $pagamento->getDataPagamento() <= $data_fim) {
                array_push($pagamentos_data_filtrada, $pagamento);
                $valor_faturado_total += $pagamento->getValorTotalPagamento();
            }
        }

        return $valor_faturado_total;
    }

    public function caculaTaxaCartao($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final)
    {
        $data_inicio = new DateTime("$ano_inicial-$mes_inicial-$dia_inicial");
        $data_fim = new DateTime("$ano_final-$mes_final-$dia_final");

        $pagamentos_data_filtrada = [];
        $valor_taxado_cartao_total = 0;

        // filtrar os pagamentos que estão entre as datas desejadas
        foreach ($this->pagamentos_efetuados as $pagamento) {
            if ($pagamento->getDataPagamento() >= $data_inicio && $pagamento->getDataPagamento() <= $data_fim) {
                array_push($pagamentos_data_filtrada, $pagamento);
                $valor_taxado_cartao_total += $pagamento->getValorTaxamento();
            }
        }

        return $valor_taxado_cartao_total;
    }

    public function caculaImposto($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final)
    {
        $data_inicio = new DateTime("$ano_inicial-$mes_inicial-$dia_inicial");
        $data_fim = new DateTime("$ano_final-$mes_final-$dia_final");

        $pagamentos_data_filtrada = [];
        $valor_imposto_total = 0;

        // filtrar os pagamentos que estão entre as datas desejadas
        foreach ($this->pagamentos_efetuados as $pagamento) {
            if ($pagamento->getDataPagamento() >= $data_inicio && $pagamento->getDataPagamento() <= $data_fim) {
                array_push($pagamentos_data_filtrada, $pagamento);
                $valor_imposto_total += $pagamento->getValorImposto();
            }
        }

        return $valor_imposto_total;
    }

    public function caculaReceita($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final)
    {
        $valor_total_faturado = $this->caculaValorFaturado($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final);
        $valor_total_taxa_cartao = $this->caculaTaxaCartao($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final);
        $valor_total_imposto = $this->caculaImposto($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final);

        return ($valor_total_faturado - $valor_total_taxa_cartao - $valor_total_imposto);
    }
}
