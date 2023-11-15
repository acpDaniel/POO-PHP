<?php

include_once "class.formaPagamento.php";

class Pagamento
{
    private FormaPagamento $forma_pagamento;
    private $valor_total_pagamento;
    private $valor_pago_impostos;
    private $valor_do_taxamento;
    // objeto de data instanciado com (ano,mes,dia)
    private DateTime $data_pagamento;

    public function __construct($forma_pagamento, $valor_total_pagamento, $ano, $mes, $dia, $taxa_imposto)
    {
        $this->forma_pagamento = $forma_pagamento;
        $this->valor_total_pagamento = $valor_total_pagamento;
        $this->data_pagamento = new Datetime("$ano-$mes-$dia");
        $this->calculaValorImposto($taxa_imposto);
        $this->calculaValorTaxamento();
    }

    public function getFormaPagamento()
    {
        return $this->forma_pagamento;
    }

    public function setFormaPagamento(FormaPagamento $forma_pagamento)
    {
        $this->forma_pagamento = $forma_pagamento;
    }

    public function getValorTotalPagamento()
    {
        return $this->valor_total_pagamento;
    }

    public function setValorTotalPagamento($valor_total_pagamento)
    {
        $this->valor_total_pagamento = $valor_total_pagamento;
    }

    public function getDataPagamento()
    {
        return $this->data_pagamento->format('d-m-Y');
    }

    public function setDataPagamento($data_pagamento)
    {
        $this->data_pagamento = $data_pagamento;
    }

    public function calculaValorImposto($taxa_imposto)
    {
        $this->valor_pago_impostos = $taxa_imposto * $this->valor_total_pagamento;
    }

    public function getValorImposto()
    {
        return $this->valor_pago_impostos;
    }

    public function calculaValorTaxamento()
    {
        $this->valor_do_taxamento = ($this->forma_pagamento->getTaxaPagamento() * $this->valor_total_pagamento);
    }

    public function getValorTaxamento()
    {
        return $this->valor_do_taxamento;
    }
}
