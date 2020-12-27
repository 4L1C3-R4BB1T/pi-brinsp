<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Loja {

	private $dados;
	private $produtos;
	public $Retorno;

	public function index() {
		$listarProduto = new \App\Site\models\Produtos();
		$this->dados['produto'] = $listarProduto->listarProduto();
		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
		if (!empty($search)) {
			$pesquisa = new \App\site\Models\Carousel();
			$pesquisado = $pesquisa->pesquisa($search);
			$carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
			$carregarView->renderizar();
			exit;
		}
		$carregarView = new \Config\ConfigView("loja/index", $this->dados);
		$carregarView->renderizar();
	}

	public function visualizar($produtos = null) {
		$this->produtos = (int) $produtos;
		$visualizarProd = new \App\Site\models\Produtos();
		$this->dados['produto'] = $visualizarProd->visualizarProduto($this->produtos);
		$visualizarProd = new \App\Site\models\Produtos();
		$this->dados['prodRecentes'] = $visualizarProd->produtosRecentes();
		$carregarView = new \Config\ConfigView("loja/visualizar", $this->dados);
		$carregarView->renderizar();
	}

	public function listarPorTipo($tipo = null) {
		$this->tipo = (int) $tipo;
		$listarDigital = new \App\Site\models\Produtos();
		$this->dados['produto'] = $listarDigital->listarPorTipo($tipo);
		$carregarView = new \Config\ConfigView("loja/index", $this->dados);
		$carregarView->renderizar();
	}

	public function addProduto() {
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (!empty($this->dados['CadProd'])) {
			unset($this->dados['CadProd']);
			$this->dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
			$this->dados['tipo_arte'] = intval($this->dados['tipo_arte']);
			$this->dados['tipo_produto'] = intval($this->dados['tipo_produto']);
			$this->dados['preco'] = floatval($this->dados['preco']);
			$cadProd = new \App\site\Models\Produtos();
			$cadProd->cadProd($this->dados);
			if ($cadProd->getResult()) {
				$urlDestino = URL . 'loja/index';
				header("Location: $urlDestino");
			} else {
				$this->dados['form'] = $this->dados;
				$this->addProdVerPriv();
			}
		} else {
			$this->addProdVerPriv();
		}
	}

	private function addProdVerPriv() {
		$carregarView = new \Config\ConfigView("loja/addProduto");
		$carregarView->renderizar();
	}

	public function indexCart() {
		$CepDestino = filter_input(INPUT_POST, 'CepDestino', FILTER_SANITIZE_SPECIAL_CHARS);
		$Peso = "0,3";
		if (!empty($CepDestino)) {
			$Url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=29313685&sCepDestino={$CepDestino}&nVlPeso={$Peso}&nCdServico=04510&StrRetorno=xml&nIndicaCalculo=3";
			$this->Retorno = simplexml_load_string(file_get_contents($Url));
			$this->dados['frete'] = $this->Retorno->cServico->Valor;
			$this->dados['prazo'] = $this->Retorno->cServico->PrazoEntrega;
		}
		$carregarView = new \Config\ConfigView("loja/carrinho", $this->dados);
		$carregarView->renderizar();
	}

	public function addProd($id = null) {
		$this->id = (int) $id;
		$existe = false;
		$listar = new \App\Site\models\Produtos();
		$this->dados['produto'] = $listar->carrinho($this->id);
		if (isset($_SESSION['orcamento'])) {
			$orcamento = $_SESSION['orcamento'];
		} else {
			$orcamento = array();
		}
		$num = count($orcamento);
		if ($num == 0) {
			$orcamento[$num]['id'] = $this->id;
			$orcamento[$num]['imagem'] = $this->dados['produto'][0]['imagem'];
			$orcamento[$num]['titulo'] = $this->dados['produto'][0]['titulo'];
			$orcamento[$num]['preco'] = $this->dados['produto'][0]['preco'];
			$orcamento[$num]['qtd'] = 1;
		} else {
			for ($i = 0; $i < $num; $i++) {
				if ($orcamento[$i]['id'] == $this->id) {
					$existe = true;
					$indice = $i;
				}
			}
			if ($existe) {
				$orcamento[$indice]['qtd']++;
			} else {
				$orcamento[$i]['id'] = $this->id;
				$orcamento[$num]['imagem'] = $this->dados['produto'][0]['imagem'];
				$orcamento[$num]['titulo'] = $this->dados['produto'][0]['titulo'];
				$orcamento[$num]['preco'] = $this->dados['produto'][0]['preco'];
				$orcamento[$i]['qtd'] = 1;
			}
		}
		$_SESSION['orcamento'] = $orcamento;
		$this->dados['orcamento'] = $_SESSION['orcamento'];
		$carregarView = new \Config\ConfigView("loja/carrinho", $this->dados);
		$carregarView->renderizar();
	}

	public function delProd($id =  null) {
		$this->id = (int) $id;
		if (isset($_SESSION['orcamento'])) {
			$orcamento = $_SESSION['orcamento'];
		} else {
			$orcamento = array();
		}
		$num = count($orcamento);
		for ($i = 0; $i < $num; $i++) {
			if ($orcamento[$i]['id'] == $this->id) {
				$existe = true;
				$indice = $i;
			}
		}
		if ($existe) {
			unset($_SESSION['orcamento'][$indice]);
		}
		$carregarView = new \Config\ConfigView("loja/carrinho");
		$carregarView->renderizar();
	}

	public function checkout() {
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (!empty($this->dados['formCheckout'])) {
			unset($this->dados['formCheckout']);
			$CepDestino = $this->dados['cep'];
			$Peso = "0,3";
			$Url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=29313685&sCepDestino={$CepDestino}&nVlPeso={$Peso}&nCdServico=04510&StrRetorno=xml&nIndicaCalculo=3";
			$this->Retorno = simplexml_load_string(file_get_contents($Url));
			$this->dados['valor'] = (int)$_SESSION['valor'] + (int)$this->Retorno->cServico->Valor;
			$_SESSION['frete'] = (float) $this->Retorno->cServico->Valor;
			$orcamento = $_SESSION['orcamento'];
			$num = count($orcamento);
			$this->dados['id'] = array();
			$this->dados['qtd'] = array();
			for ($i = 0; $i < $num; $i++) {
				$this->dados['id'][$i] = $orcamento[$i]['id'];
				$this->dados['qtd'][$i] = $orcamento[$i]['qtd'];
			}
			$this->dados['id_prod'] = implode(",", $this->dados['id']);
			$this->dados['qtd_prod'] = implode(",", $this->dados['qtd']);
			unset($this->dados['id']);
			unset($this->dados['qtd']);
			$addCompra = new \App\Site\Models\Produtos();
			$addCompra->addCompra($this->dados);
			if (!$addCompra->getResult()) {
				$this->dados['formRetorno'] = $this->dados;
			} else {
				$this->dados['formRetorno'] = null;
			}
		}
		$carregarView = new \Config\ConfigView("loja/checkout", $this->dados);
		$carregarView->renderizar();
	}
	
}
