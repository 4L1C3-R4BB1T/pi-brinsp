<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Galeria {

	private $result;
	private $tabela = 'post';

	public function listar() {
		$listar = new \Site\models\helper\ModelsRead();
		$listar->exeReadEspecifico(
			"SELECT p.id, p.titulo, p.imagem
			FROM {$this->tabela} p  
			ORDER BY p.data_criacao DESC 
			LIMIT :limit", "limit=16");
		$this->result['imagens'] = $listar->getResult();
		return $this->result['imagens'];
	}

	public function visualizarPost($post = null) {
		$this->post = $post;
		$visualizar = new \Site\models\helper\modelsRead();
		$visualizar->exeReadEspecifico(
			"SELECT p.imagem, p.titulo, p.descricao, p.usuario, u.nome, tp.descricao tp
            FROM {$this->tabela} p, tipo_arte tp, usuario u                      
        	WHERE p.id = :idpost 
				AND p.tipo_arte = tp.id
				AND p.usuario = u.id
            LIMIT :limit", "idpost={$this->post}&limit=1");
		$this->result['post'] = $visualizar->getResult();
		return $this->result['post'];
	}

	public function postsRecentes() {
		$listarRecentes = new \Site\models\helper\modelsRead();
		$listarRecentes->exeReadEspecifico(
			"SELECT *
			FROM {$this->tabela} p	
			ORDER BY p.data_criacao DESC 
			LIMIT :limit", "limit=4");
		$this->result['postRecentes'] = $listarRecentes->getResult();
		return $this->result['postRecentes'];
	}

	public function cadPost(array $dados) {
		$this->dados = $dados;
		$this->foto = $this->dados['imagem_nova'];
		unset($this->dados['imagem_nova']);
		$valCampoVazio = new \App\adm\models\helper\ModelsCampoVazio();
		$valCampoVazio->validarDados($this->dados);
		if ($valCampoVazio->getResult()) {
			$this->inserirPost();
		} else {
			$this->result = false;
		}
	}

	private function inserirPost() {
		$this->dados['data_criacao'] = date("Y-m-d H:i:s");
		$slugImg = new \App\site\Models\helper\ModelsSlug();
		$this->dados['imagem'] = $slugImg->nomeSlug($this->foto['name']);
		$this->dados['usuario'] = intval($_SESSION['usuario_id']);
		if (empty($this->foto['name'])) {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o post não foi realizado! Necessário inserir uma imagem!\" });</script>";
			$this->result = false;
		} else {
			$cadPost = new \Site\models\helper\ModelsCreate();
			$cadPost->exeCreate("post", $this->dados);
			if ($cadPost->getResult()) {
				$this->dados['id'] = $cadPost->getResult();
				$this->valFoto();
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o post não foi realizado!\" });</script>";
				$this->result = false;
			}
		}
	}

	private function valFoto() {
		$uploadImg = new \App\site\models\helper\ModelsUploadImg();
		$uploadImg->uploadImagem($this->foto, 'assets/img/galeria/', $this->dados['imagem']);
		if ($uploadImg->getResult()) {
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Post realizado com sucesso!\" });</script>";
			$this->result = true;
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o post não foi realizado!\" });</script>";
			$this->result = false;
		}
	}

	public function listarPorTipo($tipo = null) {
		$this->tipo = (int) $tipo;
		$listar = new \Site\models\helper\ModelsRead();
		$listar->exeReadEspecifico(
			"SELECT p.*
			FROM {$this->tabela} p 
			WHERE p.tipo_arte = {$this->tipo}
			ORDER BY p.id DESC 
			LIMIT :limit", "limit=16");
		$this->result['produto'] = $listar->getResult();
		return $this->result['produto'];
	}

	function getResult() {
		return $this->result;
	}

}
