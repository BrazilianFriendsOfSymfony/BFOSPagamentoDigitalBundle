<?php

namespace BFOS\PagamentoDigitalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class GatewayController extends Controller
{

  /**
   * @Route("/pagamento-digital/{id}", name="pagamento_digital_redirecionar", requirements={"id" = "\d+"})
   **/
  public function redirecionarAction($id) {

    $repositorio = $this->getDoctrine()->getRepository('BFOSPagamentoDigitalBundle:Pagamento');
    /**
     * @var \BFOS\PagamentoDigitalBundle\Entity\Pagamento $pagamento
     */
    $pagamento = $repositorio->find($id);
    $pagamento->getItens();
    $this->pagamento = $pagamento->toArray();


    return array('pagamento'=>$pagamento);
  }
  /**
   * @Route("/pagamento-digital/retorno", name="pagamento_digital_retorno")
   */
  public function verificarRespostaAction(Request $request) {

    /**
     * @var \BFOS\PagamentoDigitalBundle\PagamentoDigital\PagamentoManager $mpagto
     */
    $mpagto = $this->get('bfos_pagamentodigital.pagamento_manager');

    $mpagto->retornoPagamentoDigital($request);

  }
}
