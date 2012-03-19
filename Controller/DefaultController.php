<?php

namespace BFOS\PagamentoDigitalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
        * @Route("/confirma-pedido/{forma}/{id}", name="confirmar_pedido")
       **/
    public function redirecionarAction($forma, $id) {

        $repositorio = $this->getDoctrine()->getRepository('BFOSPagamentoDigitalBundle:Pagamento');
        /**
             * @var \BFOS\PagamentoDigitalBundle\Entity\Pagamento $pagamento
             */
        $pagamento = $repositorio->find($id);
        $pagamento->getItens();
        $this->pagamento = $pagamento->toArray();


    }
}
