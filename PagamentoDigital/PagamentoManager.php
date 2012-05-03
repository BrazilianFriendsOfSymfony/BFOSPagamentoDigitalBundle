<?php
/**
 * Created by JetBrains PhpStorm.
 * User: duo
 * Date: 2/25/12
 * Time: 2:25 PM
 * To change this template use File | Settings | File Templates.
 */
namespace BFOS\PagamentoDigitalBundle\PagamentoDigital;

use Symfony\Component\DependencyInjection\ContainerInterface;
use \BFOS\PagamentoDigitalBundle\Entity\Pagamento;
use BFOS\PagamentoDigitalBundle\Entity\PagamentoItem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use BFOS\PagamentoDigitalBundle\Entity\RespostaPagamento;
use BFOS\PagamentoDigitalBundle\Entity\RespostaPagamentoItem;
use Symfony\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Component\Validator\ConstraintViolationList;

class PagamentoManager
{
  private $container;
  /**
   * @var \BFOS\PagamentoDigitalBundle\Entity\PagamentoRepository $repository
   */
  private $repository;
  /**
   * @var \Symfony\Component\HttpKernel\Log\LoggerInterface $logger
   */
  private $logger;

  private $errors;

  function __construct(ContainerInterface $container)
  {
    $this->container  = $container;
    $this->repository = $container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Pagamento');
    $this->logger     = $container->get('logger');
  }

  /**
   * Verifica se o pagamento eh valido, ou seja, se jah pode ser submetido ao Pagamento Digital.
   *
   * @param \BFOS\PagamentoDigitalBundle\Entity\Pagamento $pagamento
   *
   * @return boolean False se o pagamento nao eh valido para ser submetido ao Pagamento Digital.
   */
  public function validarPagamentoPagamentoDigital(Pagamento $pagamento){

    $validator = $this->container->get('validator');
    $errors = $validator->validate($pagamento);

    if (count($errors) > 0){
      return $errors;
    } else {
      return true;
    }
  }

  public function persist(Pagamento $pagamento, $andFlush = true){
    if(($errors = $this->validarPagamentoPagamentoDigital($pagamento))===true){
      $this->repository->persist($pagamento);
      if($andFlush){
        $this->repository->flush();
        return true;
      }
    }
    return $errors;
  }

  /**
   * Redireciona o usuário ao Pagamento Digital. O paramêtro id é o identificador do pedido.
   *
   * @param $id
   * @return mixed
   */
  public function redirecionarPagamento($id, $response = null){

    $repositorio = $this->repository;
    $pagamento = $repositorio->find($id);

    if(!$pagamento){
      throw new \Exception('Pagamento nao encontrado');
    }

    $email_loja = urlencode($this->container->getParameter('pagamento_digital_email_loja'));
    return $this->container->get('templating')->renderResponse('BFOSPagamentoDigitalBundle:Gateway:redirecionar.html.twig', array('pagamento' => $pagamento, 'email_loja'=> $email_loja));
  }

  public function retornoPagamentoDigital(Request $request){

    $this->logger->debug('METHOD:: ' . ($request->getMethod() == 'POST'?'POST':'GET'));
    $this->logger->debug('POST:: ' . print_r($request->get('POST'), true));
    $this->logger->debug('GET:: ' . print_r($request->get('GET'), true));
    // Variáveis de retorno

    if($request->getMethod() == 'POST'){

      // Obtenha seu TOKEN entrando no menu Ferramentas do Pagamento Digital
      $token = $this->container->getParameter('pagamento_digital_token');

      /* Montando as variáveis de retorno */
      $id_transacao = $_POST['id_transacao'];
      $data_transacao = $_POST['data_transacao'];
      $data_credito = $_POST['data_credito'];
      $valor_original = $_POST['valor_original'];
      $valor_loja = $_POST['valor_loja'];
      $valor_total = $_POST['valor_total'];
      $desconto = $_POST['desconto'];
      $acrescimo = $_POST['acrescimo'];
      $tipo_pagamento = $_POST['tipo_pagamento'];
      $parcelas = $_POST['parcelas'];
      $cliente_nome = $_POST['cliente_nome'];
      $cliente_email = $_POST['cliente_email'];
      $cliente_rg = $_POST['cliente_rg'];
      $cliente_data_emissao_rg = $_POST['cliente_data_emissao_rg'];
      $cliente_orgao_emissor_rg = $_POST['cliente_orgao_emissor_rg'];
      $cliente_estado_emissor_rg = $_POST['cliente_estado_emissor_rg'];
      $cliente_cpf = $_POST['cliente_cpf'];
      $cliente_sexo = $_POST['cliente_sexo'];
      $cliente_data_nascimento = $_POST['cliente_data_nascimento'];
      $cliente_endereco = $_POST['cliente_endereco'];
      $cliente_complemento = $_POST['cliente_complemento'];
      $status = $_POST['status'];
      $cod_status = $_POST['cod_status'];
      $cliente_bairro = $_POST['cliente_bairro'];
      $cliente_cidade = $_POST['cliente_cidade'];
      $cliente_estado = $_POST['cliente_estado'];
      $cliente_cep = $_POST['cliente_cep'];
      $frete = $_POST['frete'];
      $tipo_frete = $_POST['tipo_frete'];
      $informacoes_loja = $_POST['informacoes_loja'];
      $id_pedido = $_POST['id_pedido'];
      $free = $_POST['free'];

      /* Essa variável indica a quantidade de produtos retornados */
      $qtde_produtos = $_POST['qtde_produtos'];

      /* Verificando ID da transação */
      /* Verificando status da transação */
      /* Verificando valor original */
      /* Verificando valor da loja */

      $post = "transacao=$id_transacao" .
        "&status=$status" .
        "&cod_status=$cod_status" .
        "&valor_original=$valor_original" .
        "&valor_loja=$valor_loja" .
        "&token=$token";
      $enderecoPost = "https://www.pagamentodigital.com.br/checkout/verify/";

      ob_start();
      $ch = curl_init();
      curl_setopt ($ch, CURLOPT_URL, $enderecoPost);
      curl_setopt ($ch, CURLOPT_POST, 1);
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
      curl_exec ($ch);
      $resposta = ob_get_contents();
      ob_end_clean();

      if(trim($resposta)=="VERIFICADO"){

        $this->logger->debug(sprintf("POST para URL: %s com os parametros: \n %s \n", $enderecoPost, $post));

        try {

          $resposta_pagamento = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:RespostaPagamento');
          $pagamento = $resposta_pagamento->findOneBy(array('id_pedido' => $id_pedido));

          if(!is_object($resposta_pagamento)){
            $resposta_pagamento = new RespostaPagamento();
          }

          // Loop para retornar dados dos produtos
          for ($x=1; $x <= $qtde_produtos; $x++) {

            $produto_codigo = $_POST['produto_codigo_'.$x];
            $produto_descricao = $_POST['produto_descricao_'.$x];
            $produto_qtde = $_POST['produto_qtde_'.$x];
            $produto_valor = $_POST['produto_valor_'.$x];
            $produto_extra = $_POST['produto_extra_'.$x];

            $resposta_item = new RespostaPagamentoItem();
            $resposta_item->setProdutoCodigo($produto_codigo);
            $resposta_item->setProdutoDescricao($produto_descricao);
            $resposta_item->setProdutoQtde($produto_qtde);
            $resposta_item->setProdutoValor($produto_valor);
            $resposta_item->setProdutoExtra($produto_extra);

            $this->repository->persist($resposta_item);
            $this->repository->flush();
          }
        } catch (\Exception $e){
          $this->logger->debug($e->getMessage());
          $this->logger->debug($e->getTraceAsString());
        }
      }


    }
  }
}
