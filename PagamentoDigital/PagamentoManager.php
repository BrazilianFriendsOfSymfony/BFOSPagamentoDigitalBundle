<?php

namespace BFOS\PagamentoDigitalBundle\PagamentoDigital;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BFOS\PagamentoDigitalBundle\Event\PagamentoDigitalEvents;
use BFOS\PagamentoDigitalBundle\Event\TransacaoEvent;
use \BFOS\PagamentoDigitalBundle\Entity\Pagamento;
use BFOS\PagamentoDigitalBundle\Entity\PagamentoItem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use BFOS\PagamentoDigitalBundle\Entity\Transacao;
use BFOS\PagamentoDigitalBundle\Entity\TransacaoItem;
use BFOS\PagamentoDigitalBundle\Entity\TransacaoSituacao;
use Symfony\Component\Validator\ConstraintViolationList;

class PagamentoManager
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    private $container;

    /**
     * @var \BFOS\PagamentoDigitalBundle\Entity\PagamentoRepository $repository
     */
    private $repository;

    /**
     * @var \BFOS\PagamentoDigitalBundle\Entity\TransacaoRepository $rtransacao
     */
    private $rtransacao;

    /**
     * @var \Symfony\Component\HttpKernel\Log\LoggerInterface $logger
     */
    private $logger;


    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $container->get('logger');
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(){
        return $this->container->get('doctrine')->getEntityManager();
    }

    /**
     * @return \BFOS\PagamentoDigitalBundle\Entity\PagamentoRepository
     */
    public function getRepository(){
        if(is_null($this->repository)){
            $this->repository = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Pagamento');
        }
        return $this->repository;
    }

    /**
     * @return \BFOS\PagamentoDigitalBundle\Entity\TransacaoRepository
     */
    public function getTransacaoRepository(){
        if(is_null($this->rtransacao)){
            $this->rtransacao= $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Transacao');
        }
        return $this->rtransacao;
    }

    /**
     * Verifica se o pagamento eh valido, ou seja, se jah pode ser submetido ao Pagamento Digital.
     *
     * @param \BFOS\PagamentoDigitalBundle\Entity\Pagamento $pagamento
     *
     * @return boolean False se o pagamento nao eh valido para ser submetido ao Pagamento Digital.
     */
    public function validarPagamento(Pagamento $pagamento)
    {

        $validator = $this->container->get('validator');
        $errors = $validator->validate($pagamento);

        if (count($errors) > 0) {
            return $errors;
        } else {
            return true;
        }
    }

    public function registrarPagamento(Pagamento $pagamento, $andFlush = true)
    {
        if (($errors = $this->validarPagamento($pagamento)) === true) {
            $this->getEntityManager()->persist($pagamento);
            if ($andFlush) {
                $this->getEntityManager()->flush();
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
    public function redirecionarPagamento($id, $response = null)
    {

        $pagamento = $this->getRepository()->find($id);

        if (!$pagamento) {
            throw new \Exception('Pagamento nao encontrado');
        }

        $email_loja = urlencode($pagamento->getLojaEmail());
        return $this->container->get('templating')->renderResponse('BFOSPagamentoDigitalBundle:Gateway:redirecionar.html.twig', array('pagamento' => $pagamento, 'email_loja' => $email_loja));
    }

    public function retornoPagamentoDigital(Request $request)
    {

        $this->logger->debug('PagamentoManager.retornoPagamentoDigital - METHOD:: ' . ($request->getMethod() == 'POST' ? 'POST' : 'GET'));
        $this->logger->debug('PagamentoManager.retornoPagamentoDigital - POST:: ' . print_r($request->request->all(), true));
        $this->logger->debug('PagamentoManager.retornoPagamentoDigital - GET:: ' . print_r($request->query->all(), true));
        // Variáveis de retorno

        if ($request->getMethod() == 'POST') {

            // Obtenha seu TOKEN entrando no menu Ferramentas do Pagamento Digital
//            $token = $this->container->getParameter('pagamento_digital_token');

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
            curl_setopt($ch, CURLOPT_URL, $enderecoPost);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_exec($ch);
            $resposta = ob_get_contents();
            ob_end_clean();

            if (trim($resposta) == "VERIFICADO") {

                $this->logger->debug(sprintf("POST para URL: %s com os parametros: \n %s \n", $enderecoPost, $post));

                try {

                    $resposta_pagamento = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:RespostaPagamento');
                    $pagamento = $resposta_pagamento->findOneBy(array('id_pedido' => $id_pedido));

                    if (!is_object($resposta_pagamento)) {
                        $resposta_pagamento = new Transacao();
                    }

                    // Loop para retornar dados dos produtos
                    for ($x = 1; $x <= $qtde_produtos; $x++) {

                        $produto_codigo = $_POST['produto_codigo_' . $x];
                        $produto_descricao = $_POST['produto_descricao_' . $x];
                        $produto_qtde = $_POST['produto_qtde_' . $x];
                        $produto_valor = $_POST['produto_valor_' . $x];
                        $produto_extra = $_POST['produto_extra_' . $x];

                        $resposta_item = new TransacaoItem();
                        $resposta_item->setProdutoCodigo($produto_codigo);
                        $resposta_item->setProdutoDescricao($produto_descricao);
                        $resposta_item->setProdutoQtde($produto_qtde);
                        $resposta_item->setProdutoValor($produto_valor);
                        $resposta_item->setProdutoExtra($produto_extra);

                        $this->getEntityManager()->persist($resposta_item);
                        $this->getEntityManager()->flush();
                    }
                } catch (\Exception $e) {
                    $this->logger->debug($e->getMessage());
                    $this->logger->debug($e->getTraceAsString());
                }
            }


        }
    }


    public function processarAviso(Request $request)
    {
        if($request->request->has('pedido')){
            $pedido_id = $request->request->get('pedido');
        }
        if($request->request->has('transacao_id')){
            $transacao_id = $request->request->get('transacao_id');
        }

        if(!isset($pedido_id) || !isset($transacao_id)){
            return false;
        }

        try {
            $pagamento = $this->getRepository()->findOneBy(array('id_pedido' => $pedido_id));
            if($pagamento){
                $transacao = $this->consultarTransacao($pagamento, $transacao_id);
                if($transacao !== false) {

                    $event = new TransacaoEvent($transacao);
                    $this->container->get('event_dispatcher')->dispatch(PagamentoDigitalEvents::onNotificacaoTransacao, $event);

                }
                return $transacao;

            } else {
                return false;
            }
        } catch (\Exception $e) {
        }
    }

    public function consultarTransacao(Pagamento $pagamento, $transacao_id = null)
    {
        $this->logger->info('PagamentoManager->consultarTransacao(): pagamento_id = ' . $pagamento->getId() . ' - pedido_Id = ' . $pagamento->getIdPedido() . ' - transacao_id = ' . $transacao_id);

        $urlConsulta = "https://www.pagamentodigital.com.br/transacao/consulta/";

        // Email cadastrado no Pagamento Digital
        $email = $pagamento->getLojaEmail();

        // Obtenha seu TOKEN entrando no menu Ferramentas do Pagamento Digital
        $token = $pagamento->getLojaToken();

//        $urlPost = "https://www.pagamentodigital.com.br/transacao/consulta/";
//        $transacaoId = "### Coloque aqui o id da TRANSACAO a ser consultada ###";
        $pedidoId = $pagamento->getIdPedido();
        $tipoRetorno = 2; // json
        $codificacao = 1; // UTF-8

        ob_start();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlConsulta);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("id_pedido" => $pedidoId, "tipo_retorno" => $tipoRetorno, "codificacao" => $codificacao));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic " . base64_encode($email . ":" . $token)));
        curl_exec($ch);

        /* XML ou Json de retorno */
        $resposta = ob_get_contents();

        ob_end_clean();

        /* Capturando o http code para tratamento dos erros na requisição*/
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != "200") {
            return false;
        } else {
            //Tratamento dos dados da transação consultada.
            $json = json_decode($resposta, true);
            $json = $json['transacao'];
            $this->logger->err("consultarTransacao :: resposta: \n" . $resposta);
            $this->logger->err("consultarTransacao :: json: \n" . print_r($json,true));
            if(is_null($transacao_id)){
                /**
                 * @var Transacao $transacao
                 */
                $transacao = $this->getTransacaoRepository()->findOneBy(array('id_pedido'=>$pagamento->getIdPedido()));
            } else {
                /**
                 * @var Transacao $transacao
                 */
                $transacao = $this->getTransacaoRepository()->findOneBy(array('id_transacao'=>$transacao_id));
            }
            if(!$transacao){
                $transacao = new Transacao();
                $transacao->setIdPedido($pagamento->getIdPedido());
                $transacao->setIdTransacao($json['id_transacao']);
                $transacao->setDataTransacao($this->brDataToDateTime($json['data_transacao']));
                $transacao->setValorOriginal($json['valor_original']);
                $transacao->setValorLoja($json['valor_loja']);
                $transacao->setValorTotal($json['valor_total']);
                $transacao->setDescontoProgramado($json['desconto_programado']);
                $transacao->setCodigoMeioPagamento($json['cod_meio_pagamento']);
                $transacao->setMeioPagamentoLabel($json['meio_pagamento']);
                $transacao->setParcelas($json['parcelas']);
                $transacao->setClienteRazaoSocial($json['cliente_razao_social']);
                $transacao->setClienteNomeFantasia($json['cliente_nome_fantasia']);
                $transacao->setClienteNome($json['cliente_nome']);
                $transacao->setClienteEmail($json['cliente_email']);
                $transacao->setClienteDataEmissaoRg($json['cliente_data_emissao_rg']);
                $transacao->setClienteOrgaoEmissorRg($json['cliente_orgao_emissor_rg']);
                $transacao->setClienteEstadoEmissorRg($json['cliente_estado_emissor_rg']);
                $transacao->setClienteCnpj($json['cliente_cnpj']);
                $transacao->setClienteSexo($json['cliente_sexo']);
                $transacao->setClienteDataNascimento($this->brDataToDateTime($json['cliente_data_nascimento']));
                $transacao->setClienteTelefone($json['cliente_telefone']);
                $transacao->setClienteEndereco($json['cliente_endereco']);
                $transacao->setClienteComplemento($json['cliente_complemento']);
                $transacao->setClienteBairro($json['cliente_bairro']);
                $transacao->setClienteCidade($json['cliente_cidade']);
                $transacao->setClienteEstado($json['cliente_estado']);
                $transacao->setClienteCep($json['cliente_cep']);
                $transacao->setFrete($json['frete']);
                $transacao->setFree($json['free']);
                $transacao->setEmailVendedor($json['email_vendedor']);

                foreach ($json['pedidos'] as $p) {
                    $item = new TransacaoItem();
                    $item->setProdutoCodigo($p['codigo_produto']);
                    $item->setProdutoDescricao($p['nome_produto']);
                    $item->setProdutoQtde($p['qtde']);
                    $item->setProdutoValor($p['valor_total']);
                    $item->setProdutoExtra($p['extra']);
                    $transacao->addItem($item);
                    $this->getEntityManager()->persist($item);
                }

            }
            $transacao->setDataCredito($this->brDataToDateTime($json['data_credito']));
            $transacao->setCodStatus($json['cod_status']);
            $transacao->setStatus($json['status']);
            $transacao->setDataAlteracaoStatus($this->brDataToDateTime($json['data_alteracao_status'], true));
            $this->getEntityManager()->persist($transacao);

            $achou = false;
            /**
             * @var TransacaoSituacao $situacao
             */
            foreach ($transacao->getSituacoes() as $situacao) {
                if($situacao->getCodigoStatus()==$transacao->getCodStatus() && $situacao->getDataAlteracaoStatus()->format('Y-m-d H:i:s')==$transacao->getDataAlteracaoStatus()->format('Y-m-d H:i:s')){
                    $achou = true;
                    break;
                }
            }
            if(!$achou){
                $situacao = new TransacaoSituacao();
                $situacao->setCodigoStatus($transacao->getCodStatus());
                $situacao->setSituacao($transacao->getStatus());
                $situacao->setDataAlteracaoStatus($transacao->getDataAlteracaoStatus());
                $transacao->addSituacao($situacao);
                $this->getEntityManager()->persist($situacao);
            }

            $this->getEntityManager()->flush();

            $this->logger->info('PagamentoManager->consultarTransacao(): TRIGGERING onConsultaTransacao');

            $event = new TransacaoEvent($transacao);
            $this->container->get('event_dispatcher')->dispatch(PagamentoDigitalEvents::onConsultaTransacao, $event);

            $this->logger->info('PagamentoManager->consultarTransacao(): BACK FROM onConsultaTransacao');

            return $transacao;
        }

    }

    public function brDataToDateTime($data, $temHora = false){
        if(empty($data)){
            return null;
        }
        if($temHora){
            $tmp0 = explode(' ', $data);
            $tmp = explode('/', $tmp0[0]);
            $result = new \DateTime($tmp[2].'-'. $tmp[1].'-'.$tmp[0] . ' ' . $tmp0[1]);
        } else {
            $tmp = explode('/', $data);
            $result = new \DateTime($tmp[2].'-'. $tmp[1].'-'.$tmp[0]);
        }
        return $result;
    }
}
