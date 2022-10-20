# tiino
Informações sobre código fonte de integração para plataforma tiino

#### Composer
    https://getcomposer.org/download/

#### Instalação libs
    composer install
    
#### Token.php
    Alterar os dados abaixo, caso não possua entre em contato com contato@tunesoft.com.br
    public const CLIENT_ID = "********";
    public const CLIENT_SECRET = "********";
    
#### Rodar a aplicação
    php index.php ou diretamente pelo browser
    
    
```php
<?php
use App\IntegracaoTiino;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Vendedor;
use App\Models\Metricas;
use App\Models\DataValor;
use App\Models\Grupo;

require __DIR__.'./vendor/autoload.php';


#----- inicio envio do pedido
$documento = "00000000000000";
$nome = "ABC";
$clienteDesde = "2021-04-29";
$clienteCodigoErp = "4";
$endereco = new Endereco("Rua", "123", "Complemento","89228200", "bairro", "Joinville", "SC");
$numeroOrdemDeVenda = "12";
$valorOrdemDeVenda = 501000;
$condicaoDePagamento = 1;
$vendedor = new Vendedor("000001", "Fulano");
$metricas = new Metricas( new DataValor("2022-10-03", 11204), 0, 0,new DataValor("2020-07-01", 14100), 74990, 100, 18830.34, 3100);


#------------- client grupo
$documentoGrupo = "00000000000000";
$nomeGrupo = "ABC";
$clienteDesdeGrupo = "2021-04-29";
$clienteCodigoErpGrupo = "4";
$enderecoGrupo = new Endereco("Rua", "123", "Complemento","89228200", "bairro", "Joinville", "SC");
$condicaoDePagamentoGrupo = 1;
$vendedorGrupo = new Vendedor("000001", "Fulano");
$metricasGrupo = new Metricas( new DataValor("2022-10-03", 11204), 0, 0,new DataValor("2020-07-01", 14100), 74990, 100, 18830.34, 3100);


$clienteGrupo = new Cliente(
    $documentoGrupo,
    $nomeGrupo,
    $clienteDesdeGrupo,
    $clienteCodigoErpGrupo,
    $enderecoGrupo,
    $condicaoDePagamentoGrupo,
    $vendedorGrupo,
    $metricasGrupo
);
#------------- client grupo


$clienteSemGrupo = new Cliente(
    $documento,
    $nome,
    $clienteDesde,
    $clienteCodigoErp,
    $endereco,
    $condicaoDePagamento,
    $vendedor,
    $metricas,
    $numeroOrdemDeVenda,
    $valorOrdemDeVenda
    [$clienteGrupo]
);

$integracao = new IntegracaoTiino();
$integracao->enviarPedido($cliente);
// $integracao->enviarPreAnalise($$clienteSemGrupo);
```