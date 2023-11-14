<?php
class FormaPagamento {
    private $nome_forma_pagamento;
    private $numero_parcelas;
    private $taxa_pagamento;
    
    public function __construct($nome_forma_pagamento, $numero_parcelas, $taxa_pagamento) {
        $this->nome_forma_pagamento = $nome_forma_pagamento;
        $this->numero_parcelas = $numero_parcelas;
        $this->taxa_pagamento = $taxa_pagamento;
    }
    
    public function getFormaPagamento() {
        return $this->nome_forma_pagamento;
    }
    
    public function setFormaPagamento($nome_forma_pagamento) {
        $this->nome_forma_pagamento = $nome_forma_pagamento;
    }
    
    public function getNumeroParcelas() {
        return $this->numero_parcelas;
    }
    
    public function setNumeroParcelas($numero_parcelas) {
        $this->numero_parcelas = $numero_parcelas;
    }
    
    public function getTaxaPagamento() {
        return $this->taxa_pagamento;
    }
    
    public function setTaxaPagamento($taxa_pagamento) {
        $this->taxa_pagamento = $taxa_pagamento;
    }
   
}
