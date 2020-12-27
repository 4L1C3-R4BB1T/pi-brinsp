<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Produtos {

	private $result;
	private $produto;
	private $tabela = 'produto';

	public function listarProduto() {
		$listar = new \Site\models\helper\ModelsRead();
		$listar->exeReadEspecifico(
			"SELECT p.id, p.titulo, p.imagem, p.descricao, p.preco
			FROM {$this->tabela} p 
			ORDER BY id DESC 
			LIMIT :limit", "limit=6");
		$this->result['produto'] = $listar->getResult();
		return $this->result['produto'];
	}

	public function listarPorTipo($tipo = null) {
		$this->tipo = (int) $tipo;
		$listar = new \Site\models\helper\ModelsRead();
		$listar->exeReadEspecifico(
			"SELECT p.id, p.titulo, p.imagem, p.descricao, p.preco
			FROM {$this->tabela} p 
			WHERE p.tipo_produto = {$this->tipo}
			ORDER BY p.id DESC 
			LIMIT :limit", "limit=6");
		$this->result['produto'] = $listar->getResult();
		return $this->result['produto'];
	}

	public function produtosRecentes() {
		$listarRecentes = new \Site\models\helper\modelsRead();
		$listarRecentes->exeReadEspecifico(
			"SELECT *
			FROM {$this->tabela}	
			ORDER BY data_criacao DESC 
			LIMIT :limit", "limit=3");
		$this->result['prodRecentes'] = $listarRecentes->getResult();
		return $this->result['prodRecentes'];
	}

	public function visualizarProduto($produto = null) {
		$this->produto = $produto;
		$visualizar = new \Site\models\helper\modelsRead();
		$visualizar->exeReadEspecifico(
			"SELECT p.*, u.nome
            FROM {$this->tabela} p, usuario u                      
            WHERE p.id = :idproduto   
				AND p.usuario = u.id
			LIMIT :limit", "idproduto={$this->produto}&limit=1");
		$this->result['produto'] = $visualizar->getResult();
		return $this->result['produto'];
	}

	public function cadProd(array $dados) {
		$this->dados = $dados;
		$this->foto = $this->dados['imagem_nova'];
		unset($this->dados['imagem_nova']);
		$valCampoVazio = new \App\site\models\helper\ModelsCampoVazio();
		$valCampoVazio->validarDados($this->dados);
		if ($valCampoVazio->getResult()) {
			$this->inserirProd();
		} else {
			$this->result = false;
		}
	}

	private function inserirProd() {
		$slugImg = new \App\site\Models\helper\ModelsSlug();
		$this->dados['imagem'] = $slugImg->nomeSlug($this->foto['name']);
		$this->dados['usuario'] = intval($_SESSION['usuario_id']);
		if (empty($this->foto['name'])) {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o produto não foi cadastrado! Necessário inserir uma imagem!\", });</script>";
			$this->result = false;
		} else {
			$cadProd = new \Site\models\helper\ModelsCreate();
			$cadProd->exeCreate($this->tabela, $this->dados);
			if ($cadProd->getResult()) {
				$this->dados['id'] = $cadProd->getResult();
				$this->valFoto();
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o produto não foi cadastrado!\", });</script>";
				$this->result = false;
			}
		}
	}

	private function valFoto() {
		$uploadImg = new \App\site\models\helper\ModelsUploadImg();
		$uploadImg->uploadImagem($this->foto, 'assets/img/loja/', $this->dados['imagem']);
		if ($uploadImg->getResult()) {
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Produto cadastrado com sucesso!\", });</script>";
			$this->result = true;
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o produto não foi cadastrado!\", });</script>";
			$this->result = false;
		}
	}

	public function carrinho($id = null) {
		$this->id = $id;
		$carrinho = new \Site\models\helper\modelsRead();
		$carrinho->exeReadEspecifico(
			"SELECT *
			FROM {$this->tabela} as p
			WHERE p.id = :idproduto
			ORDER BY data_criacao DESC 
			LIMIT :limit", "idproduto={$this->id}&limit=5");
		$this->result['carrinho'] = $carrinho->getResult();
		return $this->result['carrinho'];
	}

	public function addCompra(array $dados) {
		$this->dados = $dados;
		$valCampoVazio = new \App\site\models\helper\ModelsCampoVazio();
		$valCampoVazio->validarDados($this->dados);
		if ($valCampoVazio->getResult()) {
			$this->exeAddCompra();
		} else {
			$this->result = false;
		}
	}

	private function exeAddCompra() {
		$inserir = new \Site\models\helper\ModelsCreate();
		$inserir->exeCreate("compra", $this->dados);
		if ($inserir->getResult()) {
			$this->result = true;
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Pedido enviado com sucesso!\" });</script>";
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Pedido não enviado! Erro: {$inserir->getMsg()}\" });</script>";
		}
	}

	function getResult() {
		return $this->result;
	}

}
