<?php
namespace App\Models;

class DataValor {
    private string $data;
	private float $valor;

	public function __construct(string $data, float $valor) {
		$this->data = $data;
		$this->valor = $valor;
	}

    public function toArray(): array {
        return array(
            'data' => $this->data,
            'valor' => $this->valor
        );
    }
}