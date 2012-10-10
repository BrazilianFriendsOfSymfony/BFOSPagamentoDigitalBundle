<?php

namespace BFOS\PagamentoDigitalBundle\Twig;

use \Symfony\Component\Translation\TranslatorInterface;
use \Symfony\Component\Routing\RouterInterface;
use \Symfony\Component\DependencyInjection\Container;


use \Doctrine\ORM\EntityManager;


class TwigExtension extends \Twig_Extension
{
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Twig_Environment
     */
    protected $env;

    /**
     *
     * @var  \Symfony\Component\DependencyInjection\Container
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->env = $environment;
    }

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getEntityManager();
    }


    public function getFunctions()
    {
        return array(
            'bfos_pagamento_digital_pagamento_detalhes' => new \Twig_Function_Method($this, 'pagamentoDetalhes', array('is_safe' => array('html'))),
            'bfos_pagamento_digital_pagamento_detalhes_por_id' => new \Twig_Function_Method($this, 'pagamentoDetalhesPorId', array('is_safe' => array('html')))
        );
    }


    public function pagamentoDetalhes($id_pedido){

        $criteria = array('id_pedido' => $id_pedido);
        $criteria_pagamento = $criteria;
        $criteria_transacao = $criteria;

        $rpagamento   = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Pagamento');
        $pagamento = $rpagamento->findOneBy($criteria_pagamento);

        $rtransacao   = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Transacao');
        $transacao = $rtransacao->findOneBy($criteria_transacao);

        return $this->env->render('BFOSPagseguroBundle:Pagamento:pagamentoDetalhes.html.twig',
            array(
                'pagamento' => $pagamento,
                'transacao' => $transacao
            )
        );
    }

    public function pagamentoDetalhesPorId($pagamento_id){

        $rpagamento   = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Pagamento');
        $pagamento = $rpagamento->find($pagamento_id);
        if(!$pagamento){
            return '';
        }

        $rtransacao   = $this->container->get('doctrine')->getRepository('BFOSPagamentoDigitalBundle:Transacao');
        $transacao = null;
        try {
            $transacao = $rtransacao->findOneBy(array('id_pedido' => $pagamento->getIdPedido()));
        } catch (\Exception $e) {
        }

        return $this->env->render('BFOSPagamentoDigitalBundle:Pagamento:pagamentoDetalhes.html.twig',
            array(
                'pagamento' => $pagamento,
                'transacao' => $transacao
            )
        );
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'bfos_pagamento_digital';
    }




}
