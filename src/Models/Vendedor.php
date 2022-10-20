<?php

namespace App\Models;

class Vendedor
{
	private string $codigo;
	private string $nome;

	public function __construct(string $codigo, string $nome)
	{
		$this->codigo = $codigo;
		$this->nome = $nome;
	}

    public function toArray(): array {
		return array(
			'codigo' => $this->codigo,
			'nome' => $this->nome
		);
	}

}