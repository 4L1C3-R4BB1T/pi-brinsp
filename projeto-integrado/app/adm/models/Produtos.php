<?php

namespace App\Adm\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Produtos {

	private $limiteResultado = 40;
	private $result;

	public function listarProduto() {
		$listarProduto = new \App\adm\Models\helper\ModelsRead();
		$listarProduto->exeReadEspecifico(
			"SELECT p.id, p.titulo, p.descricao, p.preco
			FROM produto p
			ORDER BY p.id DESC 
			LIMIT :limit", "&limit={$this->limiteResultado}");
		$this->result = $listarProduto->getResult();
		return $this->result;
	}

	public function verProduto($id) {
		$this->id = (int) $id;
		$verPerfil = new \App\adm\Models\helper\ModelsRead();
		$verPerfil->exeReadEspecifico(
			"SELECT p.*, tp.descricao tipo_prod, ta.descricao tipo_art, u.nome username
            FROM produto p, tipo_produto tp, tipo_arte ta, usuario u
            WHERE p.id =:id 
				AND tp.id = p.tipo_produto
				AND ta.id = p.tipo_arte 
				AND u.id = p.usuario 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->result = $verPerfil->getResult();
		return $this->result;
	}

	public function verProdPed($id) {
		$this->id = (int) $id;
		$verPerfil = new \App\adm\Models\helper\ModelsRead();
		$verPerfil->exeReadEspecifico(
			"SELECT p.*, tp.descricao tipo_prod, ta.descricao tipo_art, u.nome username
            FROM produto p, tipo_produto tp, tipo_arte ta, usuario u
            WHERE p.id =:id 
				AND tp.id = p.tipo_produto
				AND ta.id = p.tipo_arte 
				AND u.id = p.usuario 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->dados['dados_produto'] = $verPerfil->getResult();
		return $this->dados['dados_produto'];
	}

	public function apagarProduto($id = null) {
		$this->id = (int) $id;
		$this->confirmarProduto();
		if ($this->dados) {
			$apagarProduto = new \App\adm\Models\helper\ModelsDelete();
			$apagarProduto->exeDelete("produto", "WHERE id = :id", "id={$this->id}");
			if ($apagarProduto->getResult()) {
				$apagarImg = new \App\adm\Models\helper\ModelsDelete();
				$apagarImg->apagarImg('assets/img/loja/'.$this->id.'/'.$this->dados[0]['imagem'], 'assets/img/loja/'.$this->id);
				$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Produto excluído com sucesso!\" });</script>";
				$this->result = true;
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Produto não excluído!\" });</script>";
				$this->result = false;
			}
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Produto não excluído!\" });</script>";
			$this->result = false;
		}
	}

	public function confirmarProduto() {
		$verProduto = new \App\adm\Models\helper\ModelsRead();
		$verProduto->exeReadEspecifico(
			"SELECT p.imagem 
			FROM produto p
			WHERE p.id = :id 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->dados = $verProduto->getResult();
	}

}
