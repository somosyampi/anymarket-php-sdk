# anymarket-php-sdk

Biblioteca que realiza integração com a API da [Anymarket](https=>//anymarket.com.br/)

[![Maintainability](https://api.codeclimate.com/v1/badges/f85cb8c0448cdc8e0a8f/maintainability)](https://codeclimate.com/github/somosyampi/anymarket-php-sdk/maintainability)

## Instalação via composer

```bash
$ composer require yampi/anymarket-php-sdk
```

## Serviços

Este SDK suporta os seguintes serviços

- [Produtos](#produtos)
- [Sku's](#sku's)
- [Variações](#variações)
- [Valores de variação](#valores)
- [Estoques](#estoques)
- [Marcas](#marcas)
- [Categorias](#categorias)
- [Pedidos](#pedidos)

### Configuração

Para utilizar este SDK, será necessário utilizar seu token de acesso da sua conta anymarket, e configurar o ambiente;

```php
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;

Ambiente de sandbox
$anymarket = new Anymarket('SEU_TOKEN', Environment=>=>sandbox());

Ambiente de produção
$anymarket = new Anymarket('SEU_TOKEN', Environment=>=>production());
```

### Produtos

#### Buscar todos os produtos
```php
$product = $anymarket->product()->get(0, 50);
```

#### Buscar produto
```php
$product = $anymarket->product()->find('ID_PRODUTO');
```

#### Criar produto
```php
$product = $anymarket->product()->create([
    'title '=>  'string',
    'description '=>  'string',
    'category '=> [
        'id '=> 0,
        'name '=>  'string',
        'path '=>  'string'
    ],
    'brand '=> [
        'id '=> 0,
        'name '=>  'string',
        'partnerId '=>  'string'
    ],
    'nbm '=> [
        'id '=>  'string'
    ],
    'origin '=> [
        'id '=> 0
    ],
    'model '=>  'string',
    'videoUrl '=>  'string',
    'gender '=>  'string',
    'warrantyTime '=> 0,
    'warrantyText '=>  'string',
    'height '=> 0,
    'width '=> 0,
    'weight '=> 0,
    'length '=> 0,
    'priceFactor '=> 0,
    'calculatedPrice '=> true,
    'definitionPriceScope '=>  'string',
    'characteristics '=> [
        [
            'index '=> 0,
            'name '=>  'string',
            'value '=>  'string'
        ]
    ],
    'images '=> [
        [
            'main '=> true,
            'url '=>  'string',
            'variation '=>  'string'
        ]
    ],
    'skus '=> [
        [
            'title '=>  'string ',
            'partnerId '=>  'string ',
            'ean '=>  'string ',
            'amount '=> 0,
            'price '=> 0,
            'additionalTime '=> 0,
            'variations '=> [
                    'variationName '=>  'VariationValue '
            ]
        ]
    ],
    'allowAutomaticSkuMarketplaceCreation '=> true
]);
```

#### Atualizar produto
```php
$product = $anymarket->product()->update('ID_PRODUTO', [
  'title' => 'string',
  'description' => 'string',
  'category' => [
    'id' => 0,
    'name' => 'string',
    'path' => 'string'
  ],
  'brand' => [
    'id' => 0,
    'name' => 'string',
    'partnerId' => 'string'
  ],
  'nbm' => [
    'id' => 'string'
  ],
  'origin' => [
    'id' => 0
  ],
  'model' => 'string',
  'videoUrl' => 'string',
  'gender' => 'string',
  'warrantyTime' => 0,
  'warrantyText' => 'string',
  'height' => 0,
  'width' => 0,
  'weight' => 0,
  'length' => 0,
  'priceFactor' => 0,
  'calculatedPrice' => true,
  'definitionPriceScope' => 'string',
  'characteristics' => [
    [
      'index' => 0,
      'name' => 'string',
      'value' => 'string'
    ]
  ],
  'images' => [
    [
      'main' => true,
      'url' => 'string',
      'variation' => 'string'
    ]
  ],
  'skus' => [
    [
      'title' => 'string',
      'partnerId' => 'string',
      'ean' => 'string',
      'amount' => 0,
      'price' => 0,
      'variations' => [
        'variationName' => 'VariationValue'
      ]
    ]
  ],
  'allowAutomaticSkuMarketplaceCreation' => true
]);
```

#### Atualizar título de um produto
```php
$product = $anymarket->product()->updateTitle('ID_PRODUTO', 'TÍTULO');
```

### Sku's
 **É necessario utlizar setProduct para utlizar esse recurso**
```php
$anymarket->sku()->setProduct('ID_PRODUTO');
```
#### Buscar sku's de um produto
```php
$sku = $anymarket->sku()->setProduct('ID_PRODUTO')->get(0, 50);
```

#### Buscar sku de um produto
```php
$sku = $anymarket->sku()->setProduct('ID_PRODUTO')->find('ID_SKU');
```

#### Criar um sku
```php
$sku = $anymarket->sku()->setProduct('ID_PRODUTO')->create([
    'title' => 'string',
    'partnerId' => 'string',
    'ean' => 'string',
    'amount' => 0,
    'price' => 0,
    'additionalTime' => 0,
    'variations' => [
        'variationName' => 'VariationValue'
    ]
]);
```

#### Atualizar um sku
```php
$sku = $anymarket->sku()->setProduct('ID_PRODUTO')->update('ID_SKU', [
     'title ' =>  'string ',
     'partnerId ' =>  'string ',
     'ean ' =>  'string ',
     'price ' => 0,
     'sellPrice ' => 0
]);
```

#### Atualizar título de um sku
```php
$sku = $anymarket->sku()->setProduct('ID_PRODUTO')->updateTitle('ID_SKU', 'TÍTULO')
```

#### Atualizar preço de um sku
```php
$sku = $anymarket->sku()->setProduct('ID_PRODUTO')->updatePrice('ID_SKU', 'PREÇO', 'PREÇO_VENDA');
```

### Variações

#### Buscar todas as variaçoes
Para realizar a busca das marcas é necessario passar os parâmetros offset e limit
```php
$variation = $anymarket->variation()->get(0, 50);
```

#### Buscar variação
```php
$variation = $anymarket->variation()->find('ID_VARIAÇÃO');
```

#### Criar Variação
```php
$variation = $anymarket->variation()->create([
    'name' => 'string',
    'partnerId' => 'string',
    'visualVariation' => true,
    'values' => [
        [
          'description' => 'string'
        ]
    ]
]);
```

#### Atualizar variação
```php
$variation = $anymarket->variation()->update('ID_VARIAÇÃO', [
    'name' => 'string',
    'partnerId' => 'string',
    'visualVariation' => true
]);
```

#### Excluir uma variação
```php
$variation = $anymarket->variation()->delete('ID_VARIAÇÃO');
```

### Valores de uma variação
**É necessario utlizar setVariation para utlizar esse recurso**
```php
$anymarket->variationValue()->setVariation('ID_VARIAÇÃO')
```

#### Buscar valores de uma variação
```php
$value = $anymarket->variationValue()->setVariation('ID_VARIAÇÃO')->get(0, 50);
```

#### Bucar um valor
```php
$value = $anymarket->variationValue()->setVariation('ID_VARIAÇÃO')->find('ID_VALOR');
```

#### Criar um valor para uma variação
```php
$value = $anymarket->variationValue()->setVariation('ID_VARIAÇÃO')->create([
    'description' => 'string',
    'partnerId' => 'string'
])
```

#### Atualizar valor de uma variação
```php
$value = $anymarket->variationValue()->setVariation('ID_VARIAÇÃO')->update('ID_VALOR', [
    'description' => 'string',
    'partnerId' => 'string'
]);
```

#### Excluir valor de uma variação
```php
$value = $anymarket->variationValue()->setVariation('ID_VARIAÇÃO')->find('ID_VALOR');
```

### Estoques

#### Criar estoque
```php
$stock = $anymarket->stock()->create([
     'id '=> 0,
     'partnerId '=> 0,
     'quantity '=> 0,
     'cost '=> 0,
     'additionalTime '=> 0,
     'stockLocalId '=> 0
]);
```

#### Atualizar estoque
```php
$stock = $anymarket->stock()->update('ID_SKU', [
     'id '=> 0,
     'partnerId '=> 0,
     'quantity '=> 0,
     'cost '=> 0,
     'additionalTime '=> 0,
     'stockLocalId '=> 0
]);
```

#### Atualizar quantidade em estoque
```php
$stock = $anymarket->stock()->updateStockQuantity('ID_SKU', 10);
```

#### Atualizar preço de estoque
```php
$stock = $anymarket->stock()->updatePrice('ID_SKU', 100.00);
```

#### Buscar locais de estoque
```php
$stock = $anymarket->stock()->getLocals()
```

### Marcas

#### Buscar todas as marcas
Para realizar a busca das marcas é necessario passar os parâmetros offset e limit
```php
$brands = $anymarket->brand()->get(0, 50);
```

#### Buscar marca
```php
$brands = $anymarket->brand()->find('ID_MARCA');
```

#### Criar marca
```php
$brand = $anymarket->brand()->create([
    'name' => 'Nome da marca',
    'partnerId' => 'ID da marca no parceiro'
]);
```
#### Atualizar marca
```php
$brand = $anymarket->brand()->update('ID_MARCA', [
    'name' => 'Atualização de marca'
]);
```

#### Excluir marca
```php
$brand = $anymarket->brand()->delete('ID_MARCA');
```

### Categorias

#### Buscar todas as categorias
Para realizar a busca das categorias é necessario passar os parâmetros offset e limit
```php
$category = $anymarket->category()->get(0, 50);
```

#### Buscar categoria
```php
$category = $anymarket->category()->find('ID_CATEGORIA');
```

#### Criar categoria
```php
$category = $anymarket->category()->create([
    'name' => 'Categoria',
    'partnerId' => '123',
    'priceFactor' => 1,
    'calculatedPrice' => true,
    'definitionPriceScope' => 'SKU'
]);
```

#### Atualizar categoria
```php
$category = $anymarket->category()->update('ID_CATEGORIA', [
    'name' => 'Atualizar categoria',
    'partnerId' => '1234',
    'priceFactor' => 1,
    'calculatedPrice' => true,
    'definitionPriceScope' => 'SKU'
]);
```

#### Excluir categoria
```php
$category = $anymarket->category()->delete('ID_CATEGORIA');
```
### Pedidos

#### Buscar todos os pedidos
Para realizar a busca dos pedidos é necessario passar os parâmetros offset e limit
```php
$orders = $anymarket->order()->get(0, 50);
```

#### Buscar pedido
```php
$orders = $anymarket->order()->find('ID_PEDIDO');
```

#### Atualizar status do pedido
```php
$orders = $anymarket->order()->updateStatus('ID_PEDIDO', [
    'status' => 'string',
    'invoice' => [
        'accessKey' => 'string',
        'series' => 'string',
        'number' => 'string',
        'date' => '2019-04-23T13=>25=>53Z',
        'cfop' => 'string',
        'companyStateTaxId' => 'string'
    ]
]);
```

#### Consultar feed de pedidos
```php
$orders = $anymarket->order()->feed()
```

#### Atualizar feed de pedidos
```php
$orders = $anymarket->order()->feedUpdate('ID_FEED', 'TOKEN_FEED');
```
