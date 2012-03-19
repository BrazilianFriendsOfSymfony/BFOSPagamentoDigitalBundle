<?php

namespace BFOS\PagamentoDigitalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BFOS\PagamentoDigitalBundle\Entity\PagamentoItem
 *
 * @ORM\Table(name="bfos_pagamentodigital_pagamento_item")
 * @ORM\Entity
 */
class PagamentoItem
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
     * Código que identifica o produto em sua loja.
     *
     * Presença: Obrigatório.
     * Tipo: Alfa-Númerico.
     * Formato: Um string com no máximo 50 caracteres.
     *
     * @var string $produto_codigo
     *
     * @ORM\Column(name="produto_codigo", type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=50, message="O valor inserido deve conter no máximo 50 caracteres!")
     */
    private $produto_codigo;

    /**
     * Descrição ou nome do(s) produto comprado. Será visualizada pelo cliente.
     *
     * Presença: Obrigatório.
     * Tipo: Texto.
     * Formato: Um string com no máximo 255 caracteres.
     *
     * @var string $produto_descricao
     *
     * @ORM\Column(name="produto_descricao", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $produto_descricao;

    /**
     *  Quantidade comprada deste produto.
     *
     * Presença: Obrigatório.
     * Tipo: Númerico.
     * Formato: Um inteiro com no máximo 11 caracteres.
     *
     * @var integer $produto_qtde
     *
     * @ORM\Column(name="produto_qtde", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Max(limit=99999999999, message="O valor inserido deve conter no máximo 11 dígitos!")
     */
    private $produto_qtde;

    /**
     * Valor unitário do produto. Usar "." para separar os decimais.
     *
     * Presença: Obrigatório.
     * Tipo: Decimal.
     * Formato: Usar "." para separar os decimais. Duas casas decimais.
     *
     * @var decimal $produto_valor
     *
     * @ORM\Column(name="produto_valor", type="decimal")
     *
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^\d*[0-9](\.\d*[0-9])?$/", message="O valor inserido deve conter no máximo 11 dígitos!")
     */
    private $produto_valor;

    /**
     *  Descrição adicional do produto.
     *
     * Presença: Opcional.
     * Tipos: Alfa-Numérico
     * Formato: Uma string com no máximo 255 caracteres..
     *
     * @var string $produto_info_extra
     *
     * @ORM\Column(name="produto_info_extra", type="string", length=255, nullable=true)
     *
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $produto_info_extra;

    /**
     * @var DateTime $criado_em
     */
    private $criado_em;

    function __construct(){

        $this->criado_em = new \DateTime();
    }

    /**
     * @var DateTime $atualizado_em
     */
    private $atualizado_em;

    /**
     * @var string $pagamento
     *
     * @ORM\ManyToOne(targetEntity="Pagamento", inversedBy="itens")
     * @ORM\JoinColumn(name="pagamento_id", referencedColumnName="id")
     *
     * @Assert\Type(type="\BFOS\PagamentoDigitalBundle\Entity\Pagamento")
     */
    private $pagamento;

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
     * Set produto_info_extra
     *
     * @param string $produtoInfoExtra
     */
    public function setProdutoInfoExtra($produtoInfoExtra)
    {
        $this->produto_info_extra = $produtoInfoExtra;
    }

    /**
     * Get produto_info_extra
     *
     * @return string 
     */
    public function getProdutoInfoExtra()
    {
        return $this->produto_info_extra;
    }

    /**
     * @param Pagamento $pagamento
     */
    public function setPagamento($pagamento)
    {
        $this->pagamento = $pagamento;
    }

    /**
     * @return Pagamento
     */
    public function getPagamento()
    {
        return $this->pagamento;
    }

    // retorna um array com as propriedades desta classe
    public function toArray() {
        $arr = array();
        $arr['id'] = $this->getId();
        $arr['produto_codigo'] = $this->getProdutoCodigo();
        $arr['produto_descricao'] = $this->getProdutoDescricao();
        $arr['produto_info_extra'] = $this->getProdutoInfoExtra();
        $arr['produto_qtde'] = $this->getProdutoQtde();
        $arr['produto_valor'] = $this->getProdutoValor();
        $arr['criado_em'] = $this->getCriadoEm();

        return $arr;
    }

    /**
     * @param \BFOS\PagamentoDigitalBundle\Entity\DateTime $atualizado_em
     */
    public function setAtualizadoEm($atualizado_em)
    {
        $this->atualizado_em = $atualizado_em;
    }

    /**
     * @return \BFOS\PagamentoDigitalBundle\Entity\DateTime
     */
    public function getAtualizadoEm()
    {
        return $this->atualizado_em;
    }

    /**
     * @param \BFOS\PagamentoDigitalBundle\Entity\DateTime $criado_em
     */
    public function setCriadoEm($criado_em)
    {
        $this->criado_em = $criado_em;
    }

    /**
     * @return \BFOS\PagamentoDigitalBundle\Entity\DateTime
     */
    public function getCriadoEm()
    {
        return $this->criado_em;
    }
}