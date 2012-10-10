<?php

namespace BFOS\PagamentoDigitalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BFOS\PagamentoDigitalBundle\Entity\TransacaoSituacao
 * BFOSPagamentoDigitalBundle:TransacaoSituacao
 *
 * @ORM\Table(name="bfos_pagamentodigital_transacao_situacao")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class TransacaoSituacao
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Transacao $transacao
     *
     * @ORM\ManyToOne(targetEntity="Transacao", inversedBy="situacoes")
     * @ORM\JoinColumn(name="transacao_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $transacao;

    /**
     * @var integer $situacao
     *
     * @ORM\Column(name="situacao", type="string", length=50)
     */
    private $situacao;

    /**
     * Código do status da transação.
     *          cod_status = 0 - Transação em Andamento = Pagamento Digital recebeu a transação, está analisando ou aguardando o pagamento.
     *          cod_status = 1 - Transação Concluída = quando a transação já passou pelo o processo e foi finalizada, ou foi confirmado o pagamento.
     *          cod_status = 2 - Transação Cancelada = por qualquer motivo a transação foi cancelada, pagamento foi negado, estornado, ocorreu um chargeback.
     *
     * @var integer $cod_status
     *
     * @ORM\Column(name="cod_status", type="integer", nullable=true)
     */
    private $codigoStatus;

    /**
     * @var \DateTime $dataAlteracaoStatus
     *
     * @ORM\Column(name="data_alteracao_status", type="datetime", nullable=true)
     */
    private $dataAlteracaoStatus;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set situacao
     *
     * @param string $situacao
     * @return TransacaoSituacao
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    
        return $this;
    }

    /**
     * Get situacao
     *
     * @return string 
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set transacao
     *
     * @param \BFOS\PagamentoDigitalBundle\Entity\Transacao $transacao
     * @return TransacaoSituacao
     */
    public function setTransacao(\BFOS\PagamentoDigitalBundle\Entity\Transacao $transacao)
    {
        $this->transacao = $transacao;
    
        return $this;
    }

    /**
     * Get transacao
     *
     * @return \BFOS\PagamentoDigitalBundle\Entity\Transacao
     */
    public function getTransacao()
    {
        return $this->transacao;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return TransacaoSituacao
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return TransacaoSituacao
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set codigoStatus
     *
     * @param integer $codigoStatus
     * @return TransacaoSituacao
     */
    public function setCodigoStatus($codigoStatus)
    {
        $this->codigoStatus = $codigoStatus;
    
        return $this;
    }

    /**
     * Get codigoStatus
     *
     * @return integer 
     */
    public function getCodigoStatus()
    {
        return $this->codigoStatus;
    }

    /**
     * Get codigo status label
     *
     * @return string
     */
    public function getCodigoStatusLabel()
    {
        if(!isset(Transacao::$status_label[$this->codigoStatus])){
            return '';
        }
        return Transacao::$status_label[$this->codigoStatus];
    }


    /**
     * Set dataAlteracaoStatus
     *
     * @param \DateTime $dataAlteracaoStatus
     * @return TransacaoSituacao
     */
    public function setDataAlteracaoStatus($dataAlteracaoStatus)
    {
        $this->dataAlteracaoStatus = $dataAlteracaoStatus;
    
        return $this;
    }

    /**
     * Get dataAlteracaoStatus
     *
     * @return \DateTime 
     */
    public function getDataAlteracaoStatus()
    {
        return $this->dataAlteracaoStatus;
    }
}