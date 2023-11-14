<?php

include_once "class.orcamento.php";
include_once "FormaPagamento.php";
include_once "consultaExecucao.php";
include_once "Pagamento.php";

class Tratamento extends Orcamento
{
    private FormaPagamento $forma_pagamento_proposto;
    private Datetime $data;
    private array $infos_procedimentos = [];
    private $pagamentos_efetuados = [];

    public function __construct($forma_pagamento_proposto, $data, $paciente, $dentista_avaliador, $data_orcamento, $procedimentos)
    {

        parent::__construct($paciente, $dentista_avaliador, $data_orcamento, $procedimentos);
        $this->forma_pagamento_proposto = $forma_pagamento_proposto;
        $this->data = $data;
    }

    public function getFormaPagamento()
    {
        return $this->forma_pagamento_proposto;
    }

    public function getData()
    {
        return $this->data;
    }


    public function setFormaPagamento($forma_pagamento)
    {
        $this->forma_pagamento_proposto = $forma_pagamento;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function adicionaProcedimento($procedimento)
    {
        // adicionando procedimentos novos ao tratamento, por enquanto a data de conclusao esta zerada e o array de consultas esta vazio
        $this->infos_procedimentos[$procedimento] = [
            'status' => "Em andamento",
            "data_conclusao" => new Datetime('0000-00-00 00:00:00'),
            'consultas' => []
        ];
    }

    public function finalizaProcedimento($procedimento)
    {
        // iniciar uma data muito antiga para servir de comparacao
        $dataMaisRecente = new DateTime('0000-00-00');

        // encontrar o procedimento, alterar o status e pegar a data da ultima consulta
        if (array_key_exists($procedimento, $this->infos_procedimentos)) {
            $this->infos_procedimentos[$procedimento]['status'] = "Finalizado";

            // procuramos a data da  ultima consulta realizada para setar como data de conclusao do procedimento
            foreach ($this->infos_procedimentos[$procedimento]['consultas'] as $consulta) {
                if ($consulta->getData() > $dataMaisRecente) {
                    $dataMaisRecente = $consulta->getData();
                }
            }

            $this->infos_procedimentos[$procedimento]['data_conclusao'] = $dataMaisRecente;
        } else {
            echo "Procedimento não encontrado\n";
        }
    }

    public function agendaConsulta($dentista, Datetime $data, $horario, $duracao_consulta, Procedimento $procedimento)
    {
        // se o procedimento não foi adicionado nós temos que adicionar
        if (!array_key_exists($procedimento, $this->infos_procedimentos)) {
            $this->adicionaProcedimento($procedimento);
        }

        // instancia uma consulta e adiciona o respectivo procedimento
        $nova_consulta = new ConsultaExecucao($dentista, $data, $horario, $duracao_consulta, $procedimento);
        $this->infos_procedimentos[$procedimento]['consultas'][] = $nova_consulta;
    }

    public function caculaValorFaturuado($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final)
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
        $valor_total_faturado = $this->caculaValorFaturuado($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final);
        $valor_total_taxa_cartao = $this->caculaTaxaCartao($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final);
        $valor_total_imposto = $this->caculaImposto($dia_inicial, $mes_inicial, $ano_inicial, $dia_final, $mes_final, $ano_final);

        return ($valor_total_faturado - $valor_total_taxa_cartao - $valor_total_imposto);
    }
}
