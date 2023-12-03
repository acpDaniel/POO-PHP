<?php

include_once "class.orcamento.php";
include_once "class.formaPagamento.php";
include_once "class.consultaExecucao.php";
include_once "class.pagamento.php";
include_once "class.infosProcedimento.php";

class Tratamento extends Orcamento
{
    private FormaPagamento $forma_pagamento_proposto;
    private Datetime $data_conclusao_tratamento;
    private $infos_procedimentos = array();
    private $pagamentos_efetuados = [];
    static $local_filename = "tratamentos.txt";

    public function __construct($id, FormaPagamento $forma_pagamento_proposto, $paciente, $dentista_avaliador, Datetime $data_orcamento, $procedimentos)
    {

        parent::__construct($id, $paciente, $dentista_avaliador, $data_orcamento, $procedimentos);
        $id_procedimento = 1;
        foreach ($procedimentos as $procedimento) {
            $this->adicionaInfosProcedimento($id_procedimento, $procedimento);
            $id_procedimento += 1;
        }
        $this->forma_pagamento_proposto = $forma_pagamento_proposto;
    }

    public function getPagamentosEfetuados()
    {
        return $this->pagamentos_efetuados;
    }

    public function getFormaPagamento()
    {
        return $this->forma_pagamento_proposto;
    }

    public function getDataConclusao()
    {
        return $this->data_conclusao_tratamento->format('d-m-Y');
    }

    public function setFormaPagamento($forma_pagamento)
    {
        $this->forma_pagamento_proposto = $forma_pagamento;
    }

    public function setDataConclusaoTratamento($data_conclusao_tratamento)
    {
        $this->data_conclusao_tratamento = $data_conclusao_tratamento;
    }

    public function adicionaInfosProcedimento($id_procedimento, $procedimento)
    {
        $novo_infos_procedimento = new InfosProcedimento($id_procedimento, $procedimento);
        array_push($this->infos_procedimentos, $novo_infos_procedimento);
    }

    public function finalizaProcedimento($procedimento, $id_procedimento, Datetime $data_conclusao)
    {
        foreach ($this->infos_procedimentos as $infos_procedimento) {
            if ($infos_procedimento->getId() == $id_procedimento) {
                $infos_procedimento->setStatus("Finalizado");
                $infos_procedimento->setDataConclusao($data_conclusao);
            }
        }
    }

    public function agendaConsulta($dentista, Datetime $dataehorario, $duracao_consulta, Procedimento $procedimento, $id_procedimento)
    {

        // instancia uma consulta e adiciona o respectivo procedimento
        $nova_consulta = new ConsultaExecucao($dentista, $dataehorario, $duracao_consulta, $procedimento);
        foreach ($this->infos_procedimentos as $infos_procedimento) {
            if ($infos_procedimento->getId() == $id_procedimento) {
                $infos_procedimento->adicionaConsulta($nova_consulta);
                $nova_consulta->save();
            }
        }
    }

    public function adicionaPagamentoEfetuado(Pagamento $pagamento)
    {
        setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese');
        // adicionar pagamento no pagamentos efetuados
        $this->pagamentos_efetuados[] = $pagamento;
        $valor_a_ser_pago_procedimento = 0;
        foreach ($pagamento->getDatasPagamento() as $data_pagamento) {
            $mesAno_do_pagamento = strftime('%B', $data_pagamento->getTimestamp()) . $data_pagamento->format('Y');

            $porcentagem_realizada_pagamento = (($pagamento->getValorTotalPagamento() / count($pagamento->getDatasPagamento())) / ($this->getValor()));

            // cada procedimento pode ser feito por um dentista diferente entao temos que checar todos procedimentos pegando a informacao do dentista de alguma consulta. Todas consultas desse procedimento sao realizadas pelo meno dentista
            foreach ($this->infos_procedimentos as $infos_procedimento) {
                $dentista_reponsavel_procedimento = $infos_procedimento->getDentistaExecutor();
                if ($dentista_reponsavel_procedimento instanceof DentistaParceiro) {
                    $objeto_dentista_parceiro_salvo_clinica = DentistaParceiro::getRecordsByField("cpf", $dentista_reponsavel_procedimento->getCpf())[0];
                    $valor_a_ser_pago_procedimento = $objeto_dentista_parceiro_salvo_clinica->calculaValorProcedimento($infos_procedimento->getProcedimento(), $porcentagem_realizada_pagamento);
                    $objeto_dentista_parceiro_salvo_clinica->incrementaSalario($mesAno_do_pagamento, $valor_a_ser_pago_procedimento);
                    $objeto_dentista_parceiro_salvo_clinica->save();
                }
            }
        }
    }

    public function calculaValorFaturado(Datetime $data_inicio, Datetime $data_fim)
    {

        $pagamentos_data_filtrada = [];
        $valor_faturado_total = 0;

        // filtrar os pagamentos que estão entre as datas desejadas
        foreach ($this->pagamentos_efetuados as $pagamento) {
            foreach ($pagamento->getDatasPagamento() as $data_pagamento) {
                if ($data_pagamento >= $data_inicio && $data_pagamento <= $data_fim) {
                    array_push($pagamentos_data_filtrada, $pagamento);
                    $valor_faturado_total += $pagamento->getValorTotalPagamento() / count($pagamento->getDatasPagamento());
                }
            }
        }

        return $valor_faturado_total;
    }

    public function calculaTaxaCartao(Datetime $data_inicio, Datetime $data_fim)
    {
        $pagamentos_data_filtrada = [];
        $valor_taxado_cartao_total = 0;

        // filtrar os pagamentos que estão entre as datas desejadas
        foreach ($this->pagamentos_efetuados as $pagamento) {
            foreach ($pagamento->getDatasPagamento() as $data_pagamento) {
                if ($data_pagamento >= $data_inicio && $data_pagamento <= $data_fim) {
                    array_push($pagamentos_data_filtrada, $pagamento);
                    $valor_taxado_cartao_total += $pagamento->getValorTaxamento() / count($pagamento->getDatasPagamento());
                }
            }
        }

        return $valor_taxado_cartao_total;
    }

    public function calculaImposto(Datetime $data_inicio, Datetime $data_fim)
    {
        $pagamentos_data_filtrada = [];
        $valor_imposto_total = 0;

        // filtrar os pagamentos que estão entre as datas desejadas
        foreach ($this->pagamentos_efetuados as $pagamento) {
            foreach ($pagamento->getDatasPagamento() as $data_pagamento) {
                if ($data_pagamento >= $data_inicio && $data_pagamento <= $data_fim) {
                    array_push($pagamentos_data_filtrada, $pagamento);
                    $valor_imposto_total += $pagamento->getValorImposto() / count($pagamento->getDatasPagamento());
                }
            }
        }

        return $valor_imposto_total;
    }

    public function calculaReceita(Datetime $data_inicio, Datetime $data_fim)
    {
        $valor_total_faturado = $this->calculaValorFaturado($data_inicio, $data_fim);
        $valor_total_taxa_cartao = $this->calculaTaxaCartao($data_inicio, $data_fim);
        $valor_total_imposto = $this->calculaImposto($data_inicio, $data_fim);

        return ($valor_total_faturado - $valor_total_taxa_cartao - $valor_total_imposto);
    }
}
