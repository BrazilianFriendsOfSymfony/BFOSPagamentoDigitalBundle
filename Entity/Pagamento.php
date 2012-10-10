<?php

namespace BFOS\PagamentoDigitalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use BFOS\PagamentoDigitalBundle\Entity\PagamentoItem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BFOS\PagamentoDigitalBundle\Entity\Pagamento
 * BFOSPagamentoDigitalBundle:Pagamento
 *
 * @ORM\Table(name="bfos_pagamentodigital_pagamento")
 * @ORM\Entity(repositoryClass="BFOS\PagamentoDigitalBundle\Entity\PagamentoRepository")
 */
class Pagamento
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
     * Código do pedido atribuído pela loja.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 50 caracteres .
     *
     * @var string $id_pedido
     *
     * @ORM\Column(name="id_pedido", type="string", length=50, nullable=true)
     *
     * @Assert\MaxLength(limit=50, message="O valor inserido deve conter no máximo 50 caracteres!")
     */
    private $id_pedido;

    /**
     * E-mail do vendedor no Pagamento Digital
     *
     * @var string $lojaEmail
     *
     * @ORM\Column(name="loja_email", type="string", length=255, nullable=true)
     */
    private $lojaEmail;

    /**
     * Token do vendedor no Pagamento Digital.
     *
     * @var string $lojaToken
     *
     * @ORM\Column(name="loja_token", type="string", length=50, nullable=true)
     */
    private $lojaToken;

    /**
     * E-mail do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 80 caracteres.
     *
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=true)
     *
     * @Assert\Email()
     * @Assert\MaxLength(limit=80, message="O valor inserido deve conter no máximo 80 caracteres!")
     */
    private $email;

    /**
     * Nome do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 80 caracteres.
     *
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=80, nullable=true)
     *
     * @Assert\MaxLength(limit=80, message="O valor inserido deve conter no máximo 80 caracteres!")
     */
    private $nome;

    /**
     * Rg do comprador.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 20 caracteres.
     *
     * @var string $rg
     *
     * @ORM\Column(name="rg", type="string", length=20, nullable=true)
     *
     * @Assert\MaxLength(limit=20, message="O valor inserido deve conter no máximo 20 caracteres!")
     */
    private $rg;

    /**
     * Data de emissão do Rg do comprador. Formato do campo: dd/mm/aaaa
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 10 caracteres.
     *
     * @var string $data_emissao_rg
     *
     * @ORM\Column(name="data_emissao_rg", type="string", length=10, nullable=true)
     *
     * @Assert\MaxLength(limit=10, message="O valor inserido deve conter no máximo 10 caracteres!")
     */
    private $data_emissao_rg;

    /**
     * Orgão que emitiu Rg do comprador.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 20 caracteres.
     *
     * @var string $orgao_emissor_rg
     *
     * @ORM\Column(name="orgao_emissor_rg", type="string", length=20, nullable=true)
     *
     * @Assert\MaxLength(limit=20, message="O valor inserido deve conter no máximo 20 caracteres!")
     */
    private $orgao_emissor_rg;

    /**
     * Estado onde foi emitido o Rg do comprador.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 2 caracteres.
     *
     * @var string $estado_emissor_rg
     *
     * @ORM\Column(name="estado_emissor_rg", type="string", length=2, nullable=true)
     *
     * @Assert\MaxLength(limit=2, message="O valor inserido deve conter no máximo 2 caracteres!")
     */
    private $estado_emissor_rg;

    /**
     * CPF do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 17 caracteres.
     *
     * @var string $cpf
     *
     * @ORM\Column(name="cpf", type="string", length=17, nullable=true)
     *
     * @Assert\MaxLength(limit=17, message="O valor inserido deve conter no máximo 17 caracteres!")
     */
    private $cpf;

    /**
     * Sexo do comprador. Formato do campo: M ou F.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 20 caracteres.
     *
     * @var string $sexo
     *
     * @ORM\Column(name="sexo", type="string", length=20, nullable=true)
     *
     * @Assert\MaxLength(limit=20, message="O valor inserido deve conter no máximo 20 caracteres!")
     */
    private $sexo;

    /**
     * Data de Nascimento do comprador. Formato do campo: dd/mm/aaaa
     *
     *  Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 10 caracteres.
     *
     * @var string $data_nascimento
     *
     * @ORM\Column(name="data_nascimento", type="string", length=10, nullable=true)
     *
     * @Assert\MaxLength(limit=10, message="O valor inserido deve conter no máximo 10 caracteres!")
     */
    private $data_nascimento;

    /**
     * Telefone do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 20 caracteres.
     *
     * @var string $telefone
     *
     * @ORM\Column(name="telefone", type="string", length=20, nullable=true)
     *
     * @Assert\MaxLength(limit=20, message="O valor inserido deve conter no máximo 20 caracteres!")
     */
    private $telefone;

    /**
     * Telefone celular do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 20 caracteres.
     *
     * @var string $celular
     *
     * @ORM\Column(name="celular", type="string", length=20, nullable=true)
     *
     * @Assert\MaxLength(limit=20, message="O valor inserido deve conter no máximo 20 caracteres!")
     */
    private $celular;

    /**
     * Endereço do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 100 caracteres.
     *
     * @var string $endereco
     *
     * @ORM\Column(name="endereco", type="string", length=100, nullable=true)
     *
     * @Assert\MaxLength(limit=100, message="O valor inserido deve conter no máximo 100 caracteres!")
     */
    private $endereco;

    /**
     * Complemento do endereço do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 80 caracteres.
     *
     * @var string $complemento
     *
     * @ORM\Column(name="complemento", type="string", length=80, nullable=true)
     *
     * @Assert\MaxLength(limit=80, message="O valor inserido deve conter no máximo 80 caracteres!")
     */
    private $complemento;

    /**
     * Bairro do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 50 caracteres.
     *
     * @var string $bairro
     *
     * @ORM\Column(name="bairro", type="string", length=50, nullable=true)
     *
     * @Assert\MaxLength(limit=50, message="O valor inserido deve conter no máximo 50 caracteres!")
     */
    private $bairro;

    /**
     * Cidade do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 255 caracteres.
     *
     * @var string $cidade
     *
     * @ORM\Column(name="cidade", type="string", length=255, nullable=true)
     *
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $cidade;

    /**
     * Estado do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 2 caracteres.
     *
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", length=2, nullable=true)
     *
     * @Assert\MaxLength(limit=2, message="O valor inserido deve conter no máximo 2 caracteres!")
     */
    private $estado;

    /**
     * CEP do cliente que fez a compra.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 9 caracteres.
     *
     * @var string $cep
     *
     * @ORM\Column(name="cep", type="string", length=9, nullable=true)
     *
     * @Assert\MaxLength(limit=9, message="O valor inserido deve conter no máximo 9 caracteres!")
     */
    private $cep;

    /**
     * Campo de Livre Digitação. Pode ser utilizado para algum parâmetro adicional de identificação da venda.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 255 caracteres.
     *
     * @var string $free
     *
     * @ORM\Column(name="free", type="string", length=255, nullable=true)
     *
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $free;

    /**
     * Tipo do frete. Sedex, encomenda, etc.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 30 caracteres.
     *
     * @var string $tipo_frete
     *
     * @ORM\Column(name="tipo_frete", type="string", length=30, nullable=true)
     *
     * @Assert\MaxLength(limit=30, message="O valor inserido deve conter no máximo 30 caracteres!")
     */
    private $tipo_frete;

    /**
     * @var integer $frete
     *
     * @ORM\Column(name="frete", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Max(limit=99999999999, message="O valor inserido deve conter no máximo 11 dígitos!")
     */
    private $frete;


    /**
     * Valor total do desconto atribuído pela loja.
     *
     * Presença: Opcional.
     * Tipo: Numérico.
     * Formato: Usar "." para separar os decimais. Duas casas decimais.
     *
     * @var integer $desconto
     *
     * @ORM\Column(name="desconto", type="integer", scale=2, nullable=true)
     *
     * @Assert\Regex(pattern="/^\d*[0-9](\.[0-9]{2})?$/", message="O Valor deve conter somente duas casas decimais!")
     */
    private $desconto;

    /**
     * Valor total do acréscimo feito pela loja.
     *
     * Presença: Opcional.
     * Tipo: Numérico.
     * Formato: Usar "." para separar os decimais. Duas casas decimais.
     *
     * @var integer $acrescimo
     *
     * @ORM\Column(name="acrescimo", type="integer", nullable=true, scale=2)
     *
     * @Assert\Regex(pattern="/^\d*[0-9](\.[0-9]{2})?$/", message="O Valor deve conter somente duas casas decimais!")
     */
    private $acrescimo;

    /**
     * URL completa para onde seu cliente será direcionado depois da finalização do pedido no Pagamento Digital.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 255 caracteres.
     *
     * @var string $url_retorno
     *
     * @ORM\Column(name="url_retorno", type="string", length=255, nullable=true)
     *
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     * @Assert\Url(message="A URL inserida não é válida!")
     */
    private $url_retorno;

    /**
     * URL completa que indica a página em sua loja virtual que receberá as informações, caso escolha integração com retorno automático
     * dos dados.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 225 caracteres.
     *
     * @var string $url_aviso
     *
     * @ORM\Column(name="url_aviso", type="string", length=255, nullable=true)
     *
     * @Assert\Url(message="A URL inserida não é válida!")
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $url_aviso;

    /**
     * Razão social do cliente.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com tamanho máximo de 225 caracteres.
     *
     * @var string $cliente_razao_social
     *
     * @ORM\Column(name="cliente_razao_social", type="string", length=255, nullable=true)
     *
     * @Assert\MaxLength(limit=255, message="O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $cliente_razao_social;

    /**
     * CNPJ do cliente.
     *
     * Presença: Opcional.
     * Tipo: Numérico.
     * Formato: Um inteiro com máximo de 30 caracteres.
     *
     * @var integer $cliente_cnpj
     *
     * @ORM\Column(name="cliente_cnpj", type="integer", nullable=true)
     *
     * @Assert\Max(limit=999999999999999999999999999999, message="O Valor inserido está fora do padrão!")
     */
    private $cliente_cnpj;

    /**
     * Número máximo de parcelas que a loja aceitará.
     *
     * Presença: Opcional.
     * Tipo: Numérico.
     * Formato: valor númerico com 2 digitos.
     *
     * @var integer $parcela_maxima
     *
     * @ORM\Column(name="parcela_maxima", type="integer", nullable=true)
     *
     * @Assert\Max(limit=99, message="O valor deve conter apenas 2 digitos")
     */
    private $parcela_maxima;

    /**
     * Auto seleção do meio de pagamento. Caso este campo venha preenchido respeitando as opções abaixo fornecidas pelo Pagamento Digital, o
     * Pagamento Digital já irá selecionar a forma de pagamento informada. Isto não impede que o comprador utilize outros meios de
     * pagamento, apenas faz uma seleção inicial.
     *         VISA	                                                      1
     *         Mastercard	                                               2
     *         American Express	                                       37
     *         AURA	                                                     45
     *         Diners	                                                     55
     *         Hipercard	                                              56
     *         Boleto	                                                     10
     *         Transferência OnLine Banco do Brasil	           58
     *         Transferência OnLine Banco Bradesco	           59
     *         Transferência OnLine Banco Itaú	                  60
     *         Transferência OnLine Banco Banrisul	           61
     *         Transferência OnLine Banco HSBC	           62
     *
     * Presença: Opcional.
     * Tipo: Numérico.
     * Formato: valor númerico com 2 digitos.
     *
     * @var integer $meio_pagamento
     *
     * @ORM\Column(name="meio_pagamento", type="integer", nullable=true)
     *
     * @Assert\Max(limit=99, message="O valor deve conter apenas 2 digitos")
     */
    private $meio_pagamento;

    /**
     * Este campo serve para redirecionar seu cliente para uma página do seu site após 30 segundos da confirmação da transação. Insira o
     * valor "true" neste campo, você será redirecionado para a URL informada no campo URL_RETORNO
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: valor númerico com 10 digitos.
     *
     * @var string $redirect
     *
     * @ORM\Column(name="redirect", type="string", length=10, nullable=true)
     *
     * @Assert\MaxLength(limit=10, message="O valor inserido deve conter no máximo 10 caracteres")
     */
    private $redirect;

    /**
     * Tempo que o Pagamento Digital aguardará, antes de redirecionar o comprador para a URL de retorno enviada pela loja. Valores
     * permitidos: 0 até 60 (segundos). Para redirecionamento imediato, use 0. Se este parâmetro vier vazio ou inválido, o Pagamento Digital
     * considerará o tempo padrão de 30 segundos.
     *
     * Presença: Opcional.
     * Tipo: Numérico.
     * Formato: valor númerico com 2 digitos.
     *
     * @var integer $redirect_time
     *
     * @ORM\Column(name="redirect_time", type="integer", nullable=true)
     *
     * @Assert\Max(limit=60, message="O valor inserido não deve ultrapassar 60!")
     */
    private $redirect_time;

    /**
     * Permite criar uma instrução criptografada das informações enviadas ao Pagamento Digital através do código html, garantindo a
     * integridade dos dados.
     *
     * Presença: Opcional.
     * Tipo: Alfa-Numérico.
     * Formato: Uma string com máximo de 255 caracteres..
     *
     * @var string $hash
     *
     * @ORM\Column(name = "hash", type = "string", length = 255, nullable = true)
     *
     * @Assert\MaxLength(limit = 255, message = "O valor inserido deve conter no máximo 255 caracteres!")
     */
    private $hash;

    /**
     * @var string $tipo_integracao
     *
     * @ORM\Column(name="tipo_integracao", type="string", length=3)
     *
     * @Assert\NotBlank()
     * @Assert\Choice(choices = { "PAD" }, message = "O único valor aceito é PAD!")
     */
    private $tipo_integracao;

    /**
     * @var ArrayCollection $itens
     *
     * @ORM\OneToMany(targetEntity="PagamentoItem", mappedBy="pagamento", cascade={"all"})
     */
    private $itens;

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
    
    function __construct()
    {
        $this->itens = new ArrayCollection();
        $this->tipo_integracao = 'PAD';
        $this->frete = 0;
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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nome
     *
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set rg
     *
     * @param string $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * Get rg
     *
     * @return string 
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set data_emissao_rg
     *
     * @param string $dataEmissaoRg
     */
    public function setDataEmissaoRg($dataEmissaoRg)
    {
        $this->data_emissao_rg = $dataEmissaoRg;
    }

    /**
     * Get data_emissao_rg
     *
     * @return string 
     */
    public function getDataEmissaoRg()
    {
        return $this->data_emissao_rg;
    }

    /**
     * Set orgao_emissor_rg
     *
     * @param string $orgaoEmissorRg
     */
    public function setOrgaoEmissorRg($orgaoEmissorRg)
    {
        $this->orgao_emissor_rg = $orgaoEmissorRg;
    }

    /**
     * Get orgao_emissor_rg
     *
     * @return string 
     */
    public function getOrgaoEmissorRg()
    {
        return $this->orgao_emissor_rg;
    }

    /**
     * Set estado_emissor_rg
     *
     * @param string $estadoEmissorRg
     */
    public function setEstadoEmissorRg($estadoEmissorRg)
    {
        $this->estado_emissor_rg = $estadoEmissorRg;
    }

    /**
     * Get estado_emissor_rg
     *
     * @return string 
     */
    public function getEstadoEmissorRg()
    {
        return $this->estado_emissor_rg;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set data_nascimento
     *
     * @param string $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->data_nascimento = $dataNascimento;
    }

    /**
     * Get data_nascimento
     *
     * @return string 
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * Get telefone
     *
     * @return string 
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set celular
     *
     * @param string $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * Get complemento
     *
     * @return string 
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * Get bairro
     *
     * @return string 
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * Get cidade
     *
     * @return string 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set cep
     *
     * @param string $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
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
     * Set desconto
     *
     * @param integer $desconto
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
    }

    /**
     * Get desconto
     *
     * @return integer 
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * Set acrescimo
     *
     * @param integer $acrescimo
     */
    public function setAcrescimo($acrescimo)
    {
        $this->acrescimo = $acrescimo;
    }

    /**
     * Get acrescimo
     *
     * @return integer 
     */
    public function getAcrescimo()
    {
        return $this->acrescimo;
    }

    /**
     * Set url_retorno
     *
     * @param string $urlRetorno
     */
    public function setUrlRetorno($urlRetorno)
    {
        $this->url_retorno = $urlRetorno;
    }

    /**
     * Get url_retorno
     *
     * @return string 
     */
    public function getUrlRetorno()
    {
        return $this->url_retorno;
    }

    /**
     * Set url_aviso
     *
     * @param string $urlAviso
     */
    public function setUrlAviso($urlAviso)
    {
        $this->url_aviso = $urlAviso;
    }

    /**
     * Get url_aviso
     *
     * @return string 
     */
    public function getUrlAviso()
    {
        return $this->url_aviso;
    }

    /**
     * Set cliente_razao_social
     *
     * @param string $clienteRazaoSocial
     */
    public function setClienteRazaoSocial($clienteRazaoSocial)
    {
        $this->cliente_razao_social = $clienteRazaoSocial;
    }

    /**
     * Get cliente_razao_social
     *
     * @return string 
     */
    public function getClienteRazaoSocial()
    {
        return $this->cliente_razao_social;
    }

    /**
     * Set cliente_cnpj
     *
     * @param integer $clienteCnpj
     */
    public function setClienteCnpj($clienteCnpj)
    {
        $this->cliente_cnpj = $clienteCnpj;
    }

    /**
     * Get cliente_cnpj
     *
     * @return integer 
     */
    public function getClienteCnpj()
    {
        return $this->cliente_cnpj;
    }

    /**
     * Set parcela_maxima
     *
     * @param integer $parcelaMaxima
     */
    public function setParcelaMaxima($parcelaMaxima)
    {
        $this->parcela_maxima = $parcelaMaxima;
    }

    /**
     * Get parcela_maxima
     *
     * @return integer 
     */
    public function getParcelaMaxima()
    {
        return $this->parcela_maxima;
    }

    /**
     * Set meio_pagamento
     *
     * @param integer $meioPagamento
     */
    public function setMeioPagamento($meioPagamento)
    {
        $this->meio_pagamento = $meioPagamento;
    }

    /**
     * Get meio_pagamento
     *
     * @return integer 
     */
    public function getMeioPagamento()
    {
        return $this->meio_pagamento;
    }

    /**
     * Set redirect
     *
     * @param string $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Get redirect
     *
     * @return string 
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set redirect_time
     *
     * @param integer $redirectTime
     */
    public function setRedirectTime($redirectTime)
    {
        $this->redirect_time = $redirectTime;
    }

    /**
     * Get redirect_time
     *
     * @return integer 
     */
    public function getRedirectTime()
    {
        return $this->redirect_time;
    }

    /**
     * Set hash
     *
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param int $frete
     */
    public function setFrete($frete)
    {
        $this->frete = $frete;
    }

    /**
     * @return int
     */
    public function getFrete()
    {
        return $this->frete;
    }

    /**
     * @param string $tipo_integracao
     */
    public function setTipoIntegracao($tipo_integracao)
    {
        $this->tipo_integracao = $tipo_integracao;
    }

    /**
     * @return string
     */
    public function getTipoIntegracao()
    {
        return $this->tipo_integracao;
    }

    /**
     * @return ArrayCollection
     */
    public function getItens()
    {
        return $this->itens;
    }

    /**
     * @param ArrayCollection $itens
     */
    public function setItens($itens)
    {
        $this->itens = new ArrayCollection();
        foreach($itens as $item){
            $this->addItem($item);
        }
    }

    public function addItem(PagamentoItem $item){
        $item->setPagamento($this);
        $this->itens[] = $item;
    }

    /**
     * Remove itens
     *
     * @param \BFOS\PagamentoDigitalBundle\Entity\PagamentoItem $item
     */
    public function removeItem(\BFOS\PagamentoDigitalBundle\Entity\PagamentoItem $item)
    {
        $this->itens->removeElement($item);
    }

    // retorna um array com as propriedades desta classe
    public function toArray(){
        $arr = array();
        $arr['id'] = $this->getId();
        $arr['pedido_id'] = $this->getIdPedido();
        $arr['acrescimo'] = $this->getAcrescimo();
        $arr['desconto'] = $this->getDesconto();
        $arr['nome'] = $this->getNome();
        $arr['email'] = $this->getEmail();
        $arr['sexo'] = $this->getSexo();
        $arr['telefone'] = $this->getTelefone();
        $arr['celular'] = $this->getCelular();
        $arr['endereco'] = $this->getEndereco();
        $arr['bairro'] = $this->getBairro();
        $arr['complemento'] = $this->getComplemento();
        $arr['cidade'] = $this->getCidade();
        $arr['estado'] = $this->getEstado();
        $arr['cep'] = $this->getCep();
        $arr['cnpj'] = $this->getClienteCnpj();
        $arr['cliente_razao_social'] = $this->getClienteRazaoSocial();
        $arr['rg'] = $this->getRg();
        $arr['orgao_emissor_rg'] = $this->getOrgaoEmissorRg();
        $arr['data_emissao_rg'] = $this->getDataEmissaoRg();
        $arr['estado_emissor_rg'] = $this->getEstadoEmissorRg();
        $arr['cpf'] = $this->getCpf();
        $arr['data_nascimento'] = $this->getDataNascimento();
        $arr['frete'] = $this->getFrete();
        $arr['url_retorno'] = $this->getUrlRetorno();
        $arr['url_aviso'] = $this->getUrlAviso();
        $arr['tipo_frete'] = $this->getTipoFrete();
        $arr['redirect'] = $this->getRedirect();
        $arr['redirect_time'] = $this->getRedirectTime();
        $arr['meio_pagamento'] = $this->getMeioPagamento();
        $arr['shippingAddressCountry'] = $this->getParcelaMaxima();
        $arr['free'] = $this->getFree();
        $arr['hash'] = $this->getHash();
        $arr['tipo_integracao'] = $this->getTipoIntegracao();

        $arr_itens = array();
        foreach($this->getItens() as $item){
            $arr_itens[] = $item->toArray();
        }
        $arr['itens'] = $arr_itens;
        return $arr;
    }



    /**
     * Set lojaEmail
     *
     * @param string $lojaEmail
     * @return Pagamento
     */
    public function setLojaEmail($lojaEmail)
    {
        $this->lojaEmail = $lojaEmail;
    
        return $this;
    }

    /**
     * Get lojaEmail
     *
     * @return string 
     */
    public function getLojaEmail()
    {
        return $this->lojaEmail;
    }

    /**
     * Set lojaToken
     *
     * @param string $lojaToken
     * @return Pagamento
     */
    public function setLojaToken($lojaToken)
    {
        $this->lojaToken = $lojaToken;
    
        return $this;
    }

    /**
     * Get lojaToken
     *
     * @return string 
     */
    public function getLojaToken()
    {
        return $this->lojaToken;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Pagamento
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
     * @return Pagamento
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

}