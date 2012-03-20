<?php

namespace BFOS\PagamentoDigitalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GatewayController extends Controller
{

    /**
        * @Route("/pagamento-digital/{id}", name="pagamento_digital_redirecionar")
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

}
