Iniciando com BFOSPagamentoDigitalBundle
========================================


## Requisitos



## Instalação

Instalação é tão simples quanto possível:

1. Baixe BFOSPagamentoDigitalBundle
2. Configure o Autoloader
3. Habilite o Bundle
4. Crie o código de integração com bundle (checkout)
5. Atualize o database schema

### Passo 1: Baixe BFOSPagamentoDigitalBundle

Os arquivos do BFOSPagamentoDigitalBundle devem ser baixados para o diretório
`vendor/bundles/BFOS/PagamentoDigitalBundle` .

Isso pode ser feito de várias maneiras, depende de sua preferência. O primeiro
método é o padrão do Symfony2.

**Utilizando o script vendors**

Adicione as linhas seguintes ao seu arquivo `deps` :

```
[BFOSPagamentoDigitalBundle]
    git=git://github.com/BrazilianFriendsOfSymfony/BFOSPagamentoDigitalBundle.git
    target=bundles/BFOS/PagamentoDigitalBundle
```

Agora, rode o script vendors para baixar o bundle:

``` bash
$ php bin/vendors install
```

**Utilizando submodules**

Se preferir utilizar submodules do git, então rode o seguinte:

``` bash
$ git submodule add git://github.com/BrazilianFriendsOfSymfony/BFOSPagamentoDigitalBundle.git vendor/bundles/BFOS/PagamentoDigitalBundle
$ git submodule update --init
```

### Passo 2: Configure o Autoloader

Adicione o namespace `BFOS` namespace ao autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    'BFOS' => __DIR__.'/../vendor/bundles',
));
```

### Step 3: Habilite o bundle

Finalmente, habilite o bundle no kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new BFOS\PagamentoDigitalBundle\BFOSPagamentoDigitalBundle(),
    );
}
```