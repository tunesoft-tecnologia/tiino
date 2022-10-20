<?php
namespace App\Models;

class Metricas
{
    private DataValor $ultimaCompra;
    private float $valorDuplicatasVencidas;
    private int $diasDuplicatasVencidas;
    private DataValor $maiorAcumulo;
    private float $faturamento;
    private float $pontualidade;
    private float $valorDuplicatasAVencer;
    private float $valorDePedidosEmAbertoSemDuplicata;

    public function __construct(
        DataValor $ultimaCompra,
        float $valorDuplicatasVencidas,
        int $diasDuplicatasVencidas,
        DataValor $maiorAcumulo,
        float $faturamento,
        float $pontualidade,
        float $valorDuplicatasAVencer,
        float $valorDePedidosEmAbertoSemDuplicata
    ) {
        $this->ultimaCompra = $ultimaCompra;
        $this->valorDuplicatasVencidas = $valorDuplicatasVencidas;
        $this->diasDuplicatasVencidas = $diasDuplicatasVencidas;
        $this->maiorAcumulo = $maiorAcumulo;
        $this->faturamento = $faturamento;
        $this->pontualidade = $pontualidade;
        $this->valorDuplicatasAVencer = $valorDuplicatasAVencer;
        $this->valorDePedidosEmAbertoSemDuplicata = $valorDePedidosEmAbertoSemDuplicata;
    }


   public function toArray() : array {
    return array(
        'ultimaCompra' => $this->ultimaCompra->toArray(),
        'valorDuplicatasVencidas' => $this->valorDuplicatasVencidas,
        'diasDuplicatasVencidas' => $this->diasDuplicatasVencidas,
        'maiorAcumulo' => $this->maiorAcumulo->toArray(),
        'faturamento' => $this->faturamento,
        'pontualidade' => $this->pontualidade,
        'valorDuplicatasAVencer' => $this->valorDuplicatasAVencer,
        'valorDePedidosEmAbertoSemDuplicata' => $this->valorDePedidosEmAbertoSemDuplicata,
    );
   }
}
