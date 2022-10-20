<?php

namespace App\Models;

class Endereco
{
	private string $rua;
	private string $numero;
	private string $complemento;
	private string $cep;
	private string $bairro;
	private string $cidade;
	private string $estado;

	public function __construct(string $rua, string $numero, string $complemento, string $cep, string $bairro, string $cidade, string $estado)
	{
		$this->rua = $rua;
		$this->numero = $numero;
		$this->complemento = $complemento;
		$this->cep = $cep;
		$this->bairro = $bairro;
		$this->cidade = $cidade;
		$this->estado = $estado;
	}


	public function toArray(): array {
        return array(
            'rua' => $this->rua,
			'numero' => $this->numero,
			'complemento' => $this->complemento,
			'cep' => $this->cep,
			'bairro' => $this->bairro,
			'cidade' => $this->cidade,
			'estado' => $this->estado,
        );
    }


}