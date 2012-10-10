<?php

namespace BFOS\PagamentoDigitalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BFOS\PagamentoDigitalBundle\Entity\TransacaoItem
 *
 * @ORM\Table(name="bfos_pagamentodigital_transacao_item")
 * @ORM\Entity
 */
class TransacaoItem
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
     * Código do produto.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 50 caracteres
     *
     * @var string $produto_codigo
     *
     * @ORM\Column(name="produto_codigo", type="string", length=50)
     */
    private $produto_codigo;

    /**
     * Descrição do produto.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 255 caracteres
     *
     * @var string $produto_descricao
     *
     * @ORM\Column(name="produto_descricao", type="string", length=255)
     */
    private $produto_descricao;

    /**
     * Quantidade do produto.
     *
     * Tipo: Numérico
     * Formato: Número com máximo de 11 caracteres
     *
     * @var integer $produto_qtde
     *
     * @ORM\Column(name="produto_qtde", type="integer")
     */
    private $produto_qtde;

    /**
     * Valor unitário do produto.
     *
     * Tipo: Numérico
     * Formato: Número com máximo de 11 caracteres
     *
     * @var Decimal $produto_valor
     *
     * @ORM\Column(name="produto_valor", type="decimal", scale=2, precision=10)
     */
    private $produto_valor;

    /**
     * Informações extras do produto.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 255 caracteres
     *
     * @var string $produto_extra
     *
     * @ORM\Column(name="produto_extra", type="string", length=255)
     */
    private $produto_extra;

    /**
     * @var Transacao $resposta
     *
     * @ORM\ManyToOne(targetEntity="Transacao", inversedBy="resposta_itens")
     * @ORM\JoinColumn(name="resposta_id", referencedColumnName="id")
     *
     * @Assert\Type(type="RespostaPagamento")
     */
    private $transacao;

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
     * Set produto_codigo
     *
     * @param string $produtoCodigo
     */
    public function setProdutoCodigo($produtoCodigo)
    {
        $this->produto_codigo = $produtoCodigo;
    }

    /**
     * Get produto_codigo
     *
     * @return string 
     */
    public function getProdutoCodigo()
    {
        return $this->produto_codigo;
    }

    /**
     * Set produto_descricao
     *
     * @param string $produtoDescricao
     */
    public function setProdutoDescricao($produtoDescricao)
    {
        $this->produto_descricao = $produtoDescricao;
    }

    /**
     * Get produto_descricao
     *
     * @return string 
     */
    public function getProdutoDescricao()
    {
        return $this->produto_descricao;
    }

    /**
     * Set produto_qtde
     *
     * @param integer $produtoQtde
     */
    public function setProdutoQtde($produtoQtde)
    {
        $this->produto_qtde = $produtoQtde;
    }

    /**
     * Get produto_qtde
     *
     * @return integer 
     */
    public function getProdutoQtde()
    {
        return $this->produto_qtde;
    }

    /**
     * Set produto_valor
     *
     * @param decimal $produtoValor
     */
    public function setProdutoValor($produtoValor)
    {
        $this->produto_valor = $produtoValor;
    }

    /**
     * Get produto_valor
     *
     * @return decimal
     */
    public function getProdutoValor()
    {
        return $this->produto_valor;
    }

    /**
     * Set produto_extra
     *
     * @param string $produtoExtra
     */
    public function setProdutoExtra($produtoExtra)
    {
        $this->produto_extra = $produtoExtra;
    }

    /**
     * Get produto_extra
     *
     * @return string 
     */
    public function getProdutoExtra()
    {
        return $this->produto_extra;
    }

    // retorna um array com as propriedades desta classe
    public function toArray() {
        $arr = array();
        $arr['produto_codigo'] = $this->getProdutoCodigo();
        $arr['produto_descricao'] = $this->getProdutoDescricao();
        $arr['produto_qtde'] = $this->getProdutoQtde();
        $arr['produto_valor'] = $this->getProdutoValor();
        $arr['produto_extra'] = $this->getProdutoExtra();
        return $arr;
    }


    /**
     * Set transacao
     *
     * @param \BFOS\PagamentoDigitalBundle\Entity\Transacao $transacao
     * @return TransacaoItem
     */
    public function setTransacao(\BFOS\PagamentoDigitalBundle\Entity\Transacao $transacao = null)
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
}