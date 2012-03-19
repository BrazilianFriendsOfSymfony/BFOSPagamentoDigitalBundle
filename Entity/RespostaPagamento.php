<?php

namespace BFOS\PagamentoDigitalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * BFOS\PagamentoDigitalBundle\Entity\RespostaPagamento
 *
 * @ORM\Table(name="bfos_pagamentodigital_resposta_pagamento")
 * @ORM\Entity(repositoryClass="BFOS\PagamentoDigitalBundle\Entity\RespostaPagamentoRepository")
 */
class RespostaPagamento
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
     * ID da transação que foi gerada no Pagamento Digital.
     *
     * Tipo: Numérico.
     * Formato: Uma string com tamanho máximo de 10 caracteres.
     *
     * @var integer $id_transacao
     *
     * @ORM\Column(name="id_transacao", type="integer")
     */
    private $id_transacao;

    /**
     * Data da transação que foi gerada no Pagamento Digital. Formato: (dd/mm/aaaa)
     *
     * Tipo: Data
     * Formato: Número máximo de 18 caracteres
     *
     * @var date $data_transacao
     *
     * @ORM\Column(name="data_transacao", type="date", nullable=true)
     */
    private $data_transacao;

    /**
     * Data que a loja receberá o crédito. Formato: (dd/mm/aaaa)
     *
     * Tipo: Data
     * Formato: Número máximo de 18 caracteres
     *
     * @var date $data_credito
     *
     * @ORM\Column(name="data_credito", type="date", nullable=true)
     */
    private $data_credito;

    /**
     * Valor original da compra.
     *
     * Tipo: Numérico
     * Formato: Número máximo de 11 caracteres
     *
     * @var Decimal $valor_original
     *
     * @ORM\Column(name="valor_original", type="decimal", nullable=true, scale=2, precision=10)
     */
    private $valor_original;

    /**
     * Valor que a loja receberá.
     *
     * Tipo: Numérico
     * Formato: Número máximo de 11 caracteres
     *
     * @var Decimal $valor_loja
     *
     * @ORM\Column(name="valor_loja", type="decimal", nullable=true, scale=2, precision=10)
     */
    private $valor_loja;

    /**
     * Valor total para o cliente, com os juros.
     *
     * Tipo: Numérico
     * Formato: Número máximo de 11 caracteres
     *
     * @var decimal $valor_total
     *
     * @ORM\Column(name="valor_total", type="decimal", nullable=true, scale=2, precision=10)
     */
    private $valor_total;

    /**
     * Valor total do desconto.
     *
     * Tipo: Numérico
     * Formato: Número máximo de 11 caracteres
     *
     * @var Decimal $desconto
     *
     * @ORM\Column(name="desconto", type="decimal", nullable=true, scale=2, precision=10)
     */
    private $desconto;

    /**
     * Valor total do acréscimo.
     *
     * Tipo: Numérico
     * Formato: Número máximo de 11 caracteres
     *
     * @var Decimal $acrescimo
     *
     * @ORM\Column(name="acrescimo", type="decimal", nullable=true, scale=2, precision=10)
     */
    private $acrescimo;

    /**
     * Tipo de pagamento que o cliente escolheu.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 80 caracteres
     *
     * @var string $tipo_pagamento
     *
     * @ORM\Column(name="tipo_pagamento", type="string", length=80, nullable=true)
     */
    private $tipo_pagamento;

    /**
     * Número de parcelas da compra.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 2 caracteres
     *
     * @var string $parcelas
     *
     * @ORM\Column(name="parcelas", type="string", length=2, nullable=true)
     */
    private $parcelas;

    /**
     * Status da transação.
     *          Transação em Andamento = Pagamento Digital recebeu a transação, está analisando ou aguardando o pagamento.
     *          Transação Concluída = quando a transação já passou pelo o processo e foi finalizada, ou foi confirmado o pagamento.
     *          Transação Cancelada = por qualquer motivo a transação foi cancelada, pagamento foi negado, estornado, ocorreu um chargeback..
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 50 caracteres
     *
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * Código do status da transação.
     *          cod_status = 0 - Transação em Andamento = Pagamento Digital recebeu a transação, está analisando ou aguardando o pagamento.
     *          cod_status = 1 - Transação Concluída = quando a transação já passou pelo o processo e foi finalizada, ou foi confirmado o pagamento.
     *          cod_status = 2 - Transação Cancelada = por qualquer motivo a transação foi cancelada, pagamento foi negado, estornado, ocorreu um chargeback.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 50 caracteres
     *
     * @var integer $cod_status
     *
     * @ORM\Column(name="cod_status", type="integer", nullable=true)
     */
    private $cod_status;

    /**
     * Nome do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 255 caracteres
     *
     * @var string $cliente_nome
     *
     * @ORM\Column(name="cliente_nome", type="string", length=255, nullable=true)
     */
    private $cliente_nome;

    /**
     * E-mail do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 80 caracteres
     *
     * @var string $cliente_email
     *
     * @ORM\Column(name="cliente_email", type="string", length=80, nullable=true)
     */
    private $cliente_email;

    /**
     * Rg do comprador.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 20 caracteres
     *
     * @var string $cliente_rg
     *
     * @ORM\Column(name="cliente_rg", type="string", length=20, nullable=true)
     */
    private $cliente_rg;

    /**
     * Data de emissão do Rg do comprador.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 10 caracteres
     *
     * @var string $cliente_data_emissao_rg
     *
     * @ORM\Column(name="cliente_data_emissao_rg", type="string", length=10, nullable=true)
     */
    private $cliente_data_emissao_rg;

    /**
     * Orgão que emitiu Rg do comprador.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 20 caracteres
     *
     * @var string $cliente_orgao_emissor_rg
     *
     * @ORM\Column(name="cliente_orgao_emissor_rg", type="string", length=20, nullable=true)
     */
    private $cliente_orgao_emissor_rg;

    /**
     * Estado onde foi emitido o Rg do comprador.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 2 caracteres
     *
     * @var string $cliente_estado_emissor_rg
     *
     * @ORM\Column(name="cliente_estado_emissor_rg", type="string", length=2, nullable=true)
     */
    private $cliente_estado_emissor_rg;

    /**
     * CPF do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 17 caracteres
     *
     * @var string $cliente_cpf
     *
     * @ORM\Column(name="cliente_cpf", type="string", length=17, nullable=true)
     */
    private $cliente_cpf;

    /**
     * Sexo do comprador.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 20 caracteres
     *
     * @var string $cliente_sexo
     *
     * @ORM\Column(name="cliente_sexo", type="string", length=20, nullable=true)
     */
    private $cliente_sexo;

    /**
     * Data de Nascimento do comprador.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 10 caracteres
     *
     * @var string $cliente_data_nascimento
     *
     * @ORM\Column(name="cliente_data_nascimento", type="string", length=10, nullable=true)
     */
    private $cliente_data_nascimento;

    /**
     * Endereço do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 100 caracteres
     *
     * @var string $cliente_endereco
     *
     * @ORM\Column(name="cliente_endereco", type="string", length=100, nullable=true)
     */
    private $cliente_endereco;

    /**
     * Complemento do endereço do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 80 caracteres
     *
     * @var string $cliente_complemento
     *
     * @ORM\Column(name="cliente_complemento", type="string", length=80, nullable=true)
     */
    private $cliente_complemento;

    /**
     * Bairro do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 50 caracteres
     *
     * @var string $cliente_bairro
     *
     * @ORM\Column(name="cliente_bairro", type="string", length=50, nullable=true)
     */
    private $cliente_bairro;

    /**
     * Cidade do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 50 caracteres
     *
     * @var string $cliente_cidade
     *
     * @ORM\Column(name="cliente_cidade", type="string", length=50, nullable=true)
     */
    private $cliente_cidade;

    /**
     * Estado do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 2 caracteres
     *
     * @var string $cliente_estado
     *
     * @ORM\Column(name="cliente_estado", type="string", length=2, nullable=true)
     */
    private $cliente_estado;

    /**
     * CEP do cliente.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 9 caracteres
     *
     * @var string $cliente_cep
     *
     * @ORM\Column(name="cliente_cep", type="string", length=9, nullable=true)
     */
    private $cliente_cep;

    /**
     * Informa o valor do frete da transação.
     *
     * @var integer $frete
     *
     * Tipo: Numérico
     * Formato: Número com máximo de 11 caracteres
     *
     * @ORM\Column(name="frete", type="integer", nullable=true)
     */
    private $frete;

    /**
     * Indica o tipo de frete escolhido: SEDEX, encomenda, etc.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 30 caracteres
     *
     * @var string $tipo_frete
     *
     * @ORM\Column(name="tipo_frete", type="string", length=30)
     */
    private $tipo_frete;

    /**
     * Informa se o cliente deseja receber informações da loja. Pode ter os valores "Sim" ou "Não".
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 3 caracteres
     *
     * @var string $informacoes_loja
     *
     * @ORM\Column(name="informacoes_loja", type="string", length=3, nullable=true)
     */
    private $informacoes_loja;

    /**
     * Número do seu pedido.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 50 caracteres
     *
     * @var string $id_pedido
     *
     * @ORM\Column(name="id_pedido", type="string", length=50, nullable=true)
     */
    private $id_pedido;

    /**
     * Dados adicionais que foram enviados no POST.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 255 caracteres
     *
     * @var string $free
     *
     * @ORM\Column(name="free", type="string", length=255, nullable=true)
     */
    private $free;

    /**
     * E-mail do vendedor.
     *
     * Tipo: Alfa-Numérico
     * Formato: String com máximo de 255 caracteres
     *
     * @var string $email_vendedor
     *
     * @ORM\Column(name="email_vendedor", type="string", length=255, nullable=true)
     */
    private $email_vendedor;

    /**
     * O conteúdo de retorno do Pagamento Digital
     *
     * @var string $resposta_text
     *
     * @ORM\Column(name="resposta_text", type="string", length=1000, nullable=true)
     */
    private $resposta_text;

    /**
     * @var \DateTime $criado_em
     *
     * @ORM\Column(name="criado_em", type="datetime", nullable=true)
     */
    private $criado_em;

    /**
     * @var RespostaPagamentoItem $resposta_itens
     *
     * @ORM\OneToMany(targetEntity="RespostaPagamentoItem", mappedBy="resposta", cascade={"all"})
     */
    private $resposta_itens;

    function __construct() {

        $this->resposta_itens = new ArrayCollection();
        $this->criado_em = new \DateTime();
    }

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
     * Set id_transacao
     *
     * @param integer $idTransacao
     */
    public function setIdTransacao($idTransacao)
    {
        $this->id_transacao = $idTransacao;
    }

    /**
     * Get id_transacao
     *
     * @return integer 
     */
    public function getIdTransacao()
    {
        return $this->id_transacao;
    }

    /**
     * Set data_transacao
     *
     * @param date $dataTransacao
     */
    public function setDataTransacao($dataTransacao)
    {
        $this->data_transacao = $dataTransacao;
    }

    /**
     * Get data_transacao
     *
     * @return date 
     */
    public function getDataTransacao()
    {
        return $this->data_transacao;
    }

    /**
     * Set data_credito
     *
     * @param date $dataCredito
     */
    public function setDataCredito($dataCredito)
    {
        $this->data_credito = $dataCredito;
    }

    /**
     * Get data_credito
     *
     * @return date 
     */
    public function getDataCredito()
    {
        return $this->data_credito;
    }

    /**
     * Set valor_original
     *
     * @param integer $valorOriginal
     */
    public function setValorOriginal($valorOriginal)
    {
        $this->valor_original = $valorOriginal;
    }

    /**
     * Get valor_original
     *
     * @return integer 
     */
    public function getValorOriginal()
    {
        return $this->valor_original;
    }

    /**
     * Set valor_loja
     *
     * @param integer $valorLoja
     */
    public function setValorLoja($valorLoja)
    {
        $this->valor_loja = $valorLoja;
    }

    /**
     * Get valor_loja
     *
     * @return integer 
     */
    public function getValorLoja()
    {
        return $this->valor_loja;
    }

    /**
     * Set valor_total
     *
     * @param decimal $valorTotal
     */
    public function setValorTotal($valorTotal)
    {
        $this->valor_total = $valorTotal;
    }

    /**
     * Get valor_total
     *
     * @return decimal
     */
    public function getValorTotal()
    {
        return $this->valor_total;
    }

    /**
     * Set desconto
     *
     * @param decimal $desconto
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
    }

    /**
     * Get desconto
     *
     * @return decimal
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * Set acrescimo
     *
     * @param decimal $acrescimo
     */
    public function setAcrescimo($acrescimo)
    {
        $this->acrescimo = $acrescimo;
    }

    /**
     * Get acrescimo
     *
     * @return decimal
     */
    public function getAcrescimo()
    {
        return $this->acrescimo;
    }

    /**
     * Set tipo_pagamento
     *
     * @param string $tipoPagamento
     */
    public function setTipoPagamento($tipoPagamento)
    {
        $this->tipo_pagamento = $tipoPagamento;
    }

    /**
     * Get tipo_pagamento
     *
     * @return string 
     */
    public function getTipoPagamento()
    {
        return $this->tipo_pagamento;
    }

    /**
     * Set parcelas
     *
     * @param string $parcelas
     */
    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;
    }

    /**
     * Get parcelas
     *
     * @return string 
     */
    public function getParcelas()
    {
        return $this->parcelas;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set cod_status
     *
     * @param integer $codStatus
     */
    public function setCodStatus($codStatus)
    {
        $this->cod_status = $codStatus;
    }

    /**
     * Get cod_status
     *
     * @return integer 
     */
    public function getCodStatus()
    {
        return $this->cod_status;
    }

    /**
     * Set cliente_nome
     *
     * @param string $clienteNome
     */
    public function setClienteNome($clienteNome)
    {
        $this->cliente_nome = $clienteNome;
    }

    /**
     * Get cliente_nome
     *
     * @return string 
     */
    public function getClienteNome()
    {
        return $this->cliente_nome;
    }

    /**
     * Set cliente_email
     *
     * @param string $clienteEmail
     */
    public function setClienteEmail($clienteEmail)
    {
        $this->cliente_email = $clienteEmail;
    }

    /**
     * Get cliente_email
     *
     * @return string 
     */
    public function getClienteEmail()
    {
        return $this->cliente_email;
    }

    /**
     * Set cliente_rg
     *
     * @param string $clienteRg
     */
    public function setClienteRg($clienteRg)
    {
        $this->cliente_rg = $clienteRg;
    }

    /**
     * Get cliente_rg
     *
     * @return string 
     */
    public function getClienteRg()
    {
        return $this->cliente_rg;
    }

    /**
     * Set cliente_data_emissao_rg
     *
     * @param string $clienteDataEmissaoRg
     */
    public function setClienteDataEmissaoRg($clienteDataEmissaoRg)
    {
        $this->cliente_data_emissao_rg = $clienteDataEmissaoRg;
    }

    /**
     * Get cliente_data_emissao_rg
     *
     * @return string 
     */
    public function getClienteDataEmissaoRg()
    {
        return $this->cliente_data_emissao_rg;
    }

    /**
     * Set cliente_orgao_emissor_rg
     *
     * @param string $clienteOrgaoEmissorRg
     */
    public function setClienteOrgaoEmissorRg($clienteOrgaoEmissorRg)
    {
        $this->cliente_orgao_emissor_rg = $clienteOrgaoEmissorRg;
    }

    /**
     * Get cliente_orgao_emissor_rg
     *
     * @return string 
     */
    public function getClienteOrgaoEmissorRg()
    {
        return $this->cliente_orgao_emissor_rg;
    }

    /**
     * Set cliente_estado_emissor_rg
     *
     * @param string $clienteEstadoEmissorRg
     */
    public function setClienteEstadoEmissorRg($clienteEstadoEmissorRg)
    {
        $this->cliente_estado_emissor_rg = $clienteEstadoEmissorRg;
    }

    /**
     * Get cliente_estado_emissor_rg
     *
     * @return string 
     */
    public function getClienteEstadoEmissorRg()
    {
        return $this->cliente_estado_emissor_rg;
    }

    /**
     * Set cliente_cpf
     *
     * @param string $clienteCpf
     */
    public function setClienteCpf($clienteCpf)
    {
        $this->cliente_cpf = $clienteCpf;
    }

    /**
     * Get cliente_cpf
     *
     * @return string 
     */
    public function getClienteCpf()
    {
        return $this->cliente_cpf;
    }

    /**
     * Set cliente_sexo
     *
     * @param string $clienteSexo
     */
    public function setClienteSexo($clienteSexo)
    {
        $this->cliente_sexo = $clienteSexo;
    }

    /**
     * Get cliente_sexo
     *
     * @return string 
     */
    public function getClienteSexo()
    {
        return $this->cliente_sexo;
    }

    /**
     * Set cliente_data_nascimento
     *
     * @param string $clienteDataNascimento
     */
    public function setClienteDataNascimento($clienteDataNascimento)
    {
        $this->cliente_data_nascimento = $clienteDataNascimento;
    }

    /**
     * Get cliente_data_nascimento
     *
     * @return string 
     */
    public function getClienteDataNascimento()
    {
        return $this->cliente_data_nascimento;
    }

    /**
     * Set cliente_endereco
     *
     * @param string $clienteEndereco
     */
    public function setClienteEndereco($clienteEndereco)
    {
        $this->cliente_endereco = $clienteEndereco;
    }

    /**
     * Get cliente_endereco
     *
     * @return string 
     */
    public function getClienteEndereco()
    {
        return $this->cliente_endereco;
    }

    /**
     * Set cliente_complemento
     *
     * @param string $clienteComplemento
     */
    public function setClienteComplemento($clienteComplemento)
    {
        $this->cliente_complemento = $clienteComplemento;
    }

    /**
     * Get cliente_complemento
     *
     * @return string 
     */
    public function getClienteComplemento()
    {
        return $this->cliente_complemento;
    }

    /**
     * Set cliente_bairro
     *
     * @param string $clienteBairro
     */
    public function setClienteBairro($clienteBairro)
    {
        $this->cliente_bairro = $clienteBairro;
    }

    /**
     * Get cliente_bairro
     *
     * @return string 
     */
    public function getClienteBairro()
    {
        return $this->cliente_bairro;
    }

    /**
     * Set cliente_cidade
     *
     * @param string $clienteCidade
     */
    public function setClienteCidade($clienteCidade)
    {
        $this->cliente_cidade = $clienteCidade;
    }

    /**
     * Get cliente_cidade
     *
     * @return string 
     */
    public function getClienteCidade()
    {
        return $this->cliente_cidade;
    }

    /**
     * Set cliente_estado
     *
     * @param string $clienteEstado
     */
    public function setClienteEstado($clienteEstado)
    {
        $this->cliente_estado = $clienteEstado;
    }

    /**
     * Get cliente_estado
     *
     * @return string 
     */
    public function getClienteEstado()
    {
        return $this->cliente_estado;
    }

    /**
     * Set cliente_cep
     *
     * @param string $clienteCep
     */
    public function setClienteCep($clienteCep)
    {
        $this->cliente_cep = $clienteCep;
    }

    /**
     * Get cliente_cep
     *
     * @return string 
     */
    public function getClienteCep()
    {
        return $this->cliente_cep;
    }

    /**
     * Set frete
     *
     * @param integer $frete
     */
    public function setFrete($frete)
    {
        $this->frete = $frete;
    }

    /**
     * Get frete
     *
     * @return integer 
     */
    public function getFrete()
    {
        return $this->frete;
    }

    /**
     * Set tipo_frete
     *
     * @param string $tipoFrete
     */
    public function setTipoFrete($tipoFrete)
    {
        $this->tipo_frete = $tipoFrete;
    }

    /**
     * Get tipo_frete
     *
     * @return string 
     */
    public function getTipoFrete()
    {
        return $this->tipo_frete;
    }

    /**
     * Set informacoes_loja
     *
     * @param string $informacoesLoja
     */
    public function setInformacoesLoja($informacoesLoja)
    {
        $this->informacoes_loja = $informacoesLoja;
    }

    /**
     * Get informacoes_loja
     *
     * @return string 
     */
    public function getInformacoesLoja()
    {
        return $this->informacoes_loja;
    }

    /**
     * Set id_pedido
     *
     * @param string $idPedido
     */
    public function setIdPedido($idPedido)
    {
        $this->id_pedido = $idPedido;
    }

    /**
     * Get id_pedido
     *
     * @return string 
     */
    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    /**
     * Set free
     *
     * @param string $free
     */
    public function setFree($free)
    {
        $this->free = $free;
    }

    /**
     * Get free
     *
     * @return string 
     */
    public function getFree()
    {
        return $this->free;
    }

    /**
     * Set email_vendedor
     *
     * @param string $emailVendedor
     */
    public function setEmailVendedor($emailVendedor)
    {
        $this->email_vendedor = $emailVendedor;
    }

    /**
     * Get email_vendedor
     *
     * @return string 
     */
    public function getEmailVendedor()
    {
        return $this->email_vendedor;
    }

    /**
     * @param string $resposta_text
     */
    public function setRespostaText($resposta_text)
    {
        $this->resposta_text = $resposta_text;
    }

    /**
     * @return string
     */
    public function getRespostaText()
    {
        return $this->resposta_text;
    }

    /**
     * @param \DateTime $criado_em
     */
    public function setCriadoEm($criado_em)
    {
        $this->criado_em = $criado_em;
    }

    /**
     * @return \DateTime
     */
    public function getCriadoEm()
    {
        return $this->criado_em;
    }

    /**
     * @param \BFOS\PagamentoDigitalBundle\Entity\ArrayCollection $itens
     */
    public function setRespostaItens($itens)
    {
        $this->resposta_itens = new ArrayCollection();
        foreach($itens as $item)
            $this->addItem($item);
    }

    public function addItem(RespostaPagamentoItem $item){

        $item->setResposta($this);
        $this->resposta_itens[] = $item;
    }

    /**
     * @return \BFOS\PagamentoDigitalBundle\Entity\RespostaPagamentoItem
     */
    public function getRespostaItens()
    {
        return $this->resposta_itens;
    }

    // retorna um array com as propriedades desta classe
    public function toArray(){
        $arr = array();
        $arr['id_transacao'] = $this->getIdTransacao();
        $arr['data_transacao'] = $this->getDataTransacao();
        $arr['data_credito'] = $this->getDataCredito();
        $arr['valor_original'] = $this->getValorOriginal();
        $arr['valor_loja'] = $this->getValorLoja();
        $arr['valor_total'] = $this->getValorTotal();
        $arr['desconto'] = $this->getDesconto();
        $arr['acrescimo'] = $this->getAcrescimo();
        $arr['tipo_pagamento'] = $this->getTipoPagamento();
        $arr['parcelas'] = $this->getParcelas();
        $arr['status'] = $this->getStatus();
        $arr['cod_status'] = $this->getCodStatus();
        $arr['cliente_nome'] = $this->getClienteNome();
        $arr['cliente_email'] = $this->getClienteEmail();
        $arr['cliente_rg'] = $this->getClienteRg();
        $arr['cliente_data_emissao_rg'] = $this->getClienteDataEmissaoRg();
        $arr['cliente_orgao_emissor_rg'] = $this->getClienteOrgaoEmissorRg();
        $arr['cliente_cpf'] = $this->getClienteCpf();
        $arr['cliente_sexo'] = $this->getClienteSexo();
        $arr['cliente_data_nascimento'] = $this->getClienteDataNascimento();
        $arr['cliente_endereco'] = $this->getClienteEndereco();
        $arr['cliente_complemento'] = $this->getClienteComplemento();
        $arr['cliente_bairro'] = $this->getClienteBairro();
        $arr['cliente_cidade'] = $this->getClienteCidade();
        $arr['cliente_estado'] = $this->getClienteEstado();
        $arr['cliente_cep'] = $this->getClienteCep();
        $arr['frete'] = $this->getFrete();
        $arr['tipo_frete'] = $this->getTipoFrete();
        $arr['informacoes_loja'] = $this->getInformacoesLoja();
        $arr['id_pedido'] = $this->getIdPedido();
        $arr['free'] = $this->getFree();
        $arr['email_vendedor'] = $this->getEmailVendedor();
        $arr['resposta_text'] = $this->getRespostaText();
        $arr['criado_em'] = $this->getCriadoEm();

        $arr_resposta_itens = array();
        foreach ($this->getRespostaItens() as $item) {
            $arr_resposta_itens[] = $item->toArray();
        }
        $arr['resposta_itens'] = $arr_resposta_itens;

        return $arr;
    }


}