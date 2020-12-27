<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Evento {

	private $result;
	private $tabela = 'evento';

	public function listar() {
		$listar = new \Site\models\helper\modelsRead();
		$listar->exeRead($this->tabela, "ORDER BY id DESC LIMIT :limit", "limit=6");
		$this->result['eventos'] = $listar->getResult();
		return $this->result['eventos'];
	}

	public function cadEvento(array $dados) {
		$this->dados = $dados;
		$this->foto = $this->dados['imagem_nova'];
		unset($this->dados['imagem_nova']);
		$valCampoVazio = new \App\site\models\helper\ModelsCampoVazio();
		$valCampoVazio->validarDados($this->dados);
		if ($valCampoVazio->getResult()) {
			$this->inserirEvento();
		} else {
			$this->result = false;
		}
	}

	private function inserirEvento() {
		$slugImg = new \App\site\Models\helper\ModelsSlug();
		$this->dados['imagem'] = $slugImg->nomeSlug($this->foto['name']);
		$this->dados['usuario'] = intval($_SESSION['usuario_id']);
		$cadEvento = new \Site\models\helper\ModelsCreate();
		$cadEvento->exeCreate("evento", $this->dados);
		if ($cadEvento->getResult()) {
			if (empty($this->foto['name'])) {
				$_SESSION['msg'] = "<div class='alert alert-success'>Evento não cadastrado!</div>";
				$this->result = false;
			} else {
				$this->dados['id'] = $cadEvento->getResult();
				$this->valFoto();
			}
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o evento não foi cadastrado!\" });</script>";
			$this->result = false;
		}
	}

	private function valFoto() {
		$uploadImg = new \App\site\models\helper\ModelsUploadImg();
		$uploadImg->uploadImagem($this->foto, 'assets/img/eventos/', $this->dados['imagem']);
		if ($uploadImg->getResult()) {
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Evento cadastrado com sucesso!\" });</script>";
			$this->result = true;
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: o evento não foi cadastrado!\" });</script>";
			$this->result = false;
		}
	}

	function getResult() {
		return $this->result;
	}

}
