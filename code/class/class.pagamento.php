<?php

include_once "class.formaPagamento.php";
require_once("persist.php");

class Pagamento extends persist
{
    private FormaPagamento $forma_pagamento;
    private $valor_total_pagamento;
    private $valor_pago_impostos;
    private $valor_do_taxamento;
    // objeto de data instanciado com (ano,mes,dia)
    private DateTime $data_pagamento;
    static $local_filename = "pagamentos.txt";

    public function __construct(FormaPagamento $forma_pagamento, $valor_total_pagamento, Datetime $data_pagamento, $taxa_imposto)
    {
        $this->forma_pagamento = $forma_pagamento;
        $this->valor_total_pagamento = $valor_total_pagamento;
        $this->data_pagamento = $data_pagamento;
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
        return $this->data_pagamento;
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

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
