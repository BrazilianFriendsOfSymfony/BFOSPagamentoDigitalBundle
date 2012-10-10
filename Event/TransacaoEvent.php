<?php
namespace BFOS\PagamentoDigitalBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use BFOS\PagamentoDigitalBundle\Entity\Transacao;

class TransacaoEvent extends Event
{
    /**
     * @var \BFOS\PagamentoDigitalBundle\Entity\Transacao $transacao
     */
    protected $transacao;

    public function __construct(Transacao $transacao)
    {
        $this->transacao = $transacao;
    }

    public function getTransacao()
    {
        return $this->transacao;
    }
}
