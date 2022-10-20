<?php
namespace App\Models;

class Cliente
{
	private string $documento;
	private string $nome;
	private string $clienteDesde;
	private string $clienteCodigoErp;
	private Endereco $endereco;
	private ?string $numeroOrdemDeVenda;
	private ?float $valorOrdemDeVenda;
	private int $condicaoDePagamento;
	private Vendedor $vendedor;
	private ?Metricas $metricas;
	/** @var Cliente[] */
	private ?array $grupo = null;

	public function __construct(string $documento, 
								string $nome,
								string $clienteDesde, 
								string $clienteCodigoErp, 
								Endereco $endereco, 
								int $condicaoDePagamento, 
								Vendedor $vendedor,
								?Metricas $metricas = null, 
								?string $numeroOrdemDeVenda = null,
								?float $valorOrdemDeVenda = null, 
								?array $grupo = null)
	{
		$this->documento = $documento;
		$this->nome = $nome;
		$this->clienteDesde = $clienteDesde;
		$this->clienteCodigoErp = $clienteCodigoErp;
		$this->endereco = $endereco;
		$this->numeroOrdemDeVenda = $numeroOrdemDeVenda;
		$this->valorOrdemDeVenda = $valorOrdemDeVenda;
		$this->condicaoDePagamento = $condicaoDePagamento;
		$this->vendedor = $vendedor;
		$this->metricas = $metricas;

		if($grupo) {
			$this->grupo = array_map(function($item) {
				return $item->toArrayClieteDoGrupo();
			}, $grupo, );
		}
	}

	public function toArrayClietePrincipal() {
		$retorno = $this->toArray();
		$retorno['clienteCodigoErp'] = $this->clienteCodigoErp;

		if($this->grupo) {
			$retorno ['grupo'] = $this->grupo;
		} 
		
		return $retorno;
	}

	public function toArrayClieteDoGrupo() {
		$retorno = $this->toArray();
		$retorno['codigoErp'] = $this->clienteCodigoErp;		
		return $retorno;
	}
    private function toArray(): array {
        $retorno = array(
            'documento' => $this->documento,
            'nome' => $this->nome,
            'clienteDesde' => $this->clienteDesde,
            'endereco' => $this->endereco->toArray(),
            'numeroOrdemDeVenda' => $this->numeroOrdemDeVenda,
            'valorOrdemDeVenda' => $this->valorOrdemDeVenda,
            'condicaoDePagamento' => $this->condicaoDePagamento,
            'vendedor' => $this->vendedor->toArray()
        );	

		if($this->metricas) {
			$retorno['metricas'] = $this->metricas->toArray();
		}

		return $retorno;
    }

}