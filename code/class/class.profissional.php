class Profissional extends Pessoa {
    protected $cpf;
    protected $endereco;

    public function __construct($nome,$email,$telefone,$cpf, $endereco) {
        parent::__construct($nome,$email,$telefone);
        $this->cpf = $cpf;
        $this->endereco = $endereco;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
}
