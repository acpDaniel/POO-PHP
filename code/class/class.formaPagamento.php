<?php
require_once("persist.php");
class FormaPagamento extends persist
{
    private string $nome_forma_pagamento;
    private int $numero_parcelas;
    private float $taxa_pagamento;
    static $local_filename = "formas_pagamento.txt";

    public function __construct($nome_forma_pagamento, $numero_parcelas, $taxa_pagamento)
    {
        $this->nome_forma_pagamento = $nome_forma_pagamento;
        $this->numero_parcelas = $numero_parcelas;
        $this->taxa_pagamento = $taxa_pagamento;
    }

    public function getNomeFormaPagamento()
    {
        return $this->nome_forma_pagamento;
    }

    public function setNomeFormaPagamento($nome_forma_pagamento)
    {
        $this->nome_forma_pagamento = $nome_forma_pagamento;
    }

    public function getNumeroParcelas()
    {
        return $this->numero_parcelas;
    }

    public function setNumeroParcelas($numero_parcelas)
    {
        $this->numero_parcelas = $numero_parcelas;
    }

    public function getTaxaPagamento()
    {
        return $this->taxa_pagamento;
    }

    public function setTaxaPagamento($taxa_pagamento)
    {
        $this->taxa_pagamento = $taxa_pagamento;
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
