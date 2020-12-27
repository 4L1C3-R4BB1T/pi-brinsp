<?php

namespace App\Adm\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Grafica {

	private $limiteResultado = 40;
	private $result;

	public function listarGrafica() {
		$listarGrafica = new \App\adm\Models\helper\ModelsRead();
		$listarGrafica->exeReadEspecifico(
			"SELECT g.id, g.nome, g.fone, g.email
			FROM graficas g
			ORDER BY g.id DESC 
			LIMIT :limit", "&limit={$this->limiteResultado}");
		$this->result = $listarGrafica->getResult();
		return $this->result;
	}

	public function verGrafica($id) {
		$this->id = (int) $id;
		$verPerfil = new \App\adm\Models\helper\ModelsRead();
		$verPerfil->exeReadEspecifico(
			"SELECT g.*
            FROM graficas g
            WHERE g.id = :id 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->result = $verPerfil->getResult();
		return $this->result;
	}
	
	public function apagarGrafica($id = null) {
		$this->id = (int) $id;
		$this->confirmarGrafica();
		if ($this->dados) {
			$apagarGrafica = new \App\adm\Models\helper\ModelsDelete();
			$apagarGrafica->exeDelete("graficas", "WHERE id =:id", "id={$this->id}");
			if ($apagarGrafica->getResult()) {
				$apagarImg = new \App\adm\Models\helper\ModelsDelete();
				$apagarImg->apagarImg('assets/img/graficas/'.$this->id.'/'.$this->dados[0]['imagem'], 'assets/img/graficas/'.$this->id);
				$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Gráfica excluída com sucesso!\" });</script>";
				$this->result = true;
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Gráfica não excluída!\" });</script>";
				$this->result = false;
			}
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Gráfica não excluída!\" });</script>";
			$this->result = false;
		}
	}

	public function confirmarGrafica() {
		$verGrafica = new \App\adm\Models\helper\ModelsRead();
		$verGrafica->exeReadEspecifico(
			"SELECT g.imagem 
			FROM graficas g
			WHERE g.id =:id 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->dados = $verGrafica->getResult();
	}

	public function cadGrafica(array $dados) {
		$this->dados = $dados;
		$this->foto = $this->dados['imagem_nova'];
		unset($this->dados['imagem_nova']);
		$valCampoVazio = new \App\adm\models\helper\ModelsCampoVazio();
		$valCampoVazio->validarDados($this->dados);
		if ($valCampoVazio->getResult()) {
			$this->valCampos();
		} else {
			$this->result = false;
		}
	}

	private function valCampos() {
		$valEmail = new \App\adm\models\helper\ModelsEmail();
		$valEmail->valEmail($this->dados['email']);
		$valEmailUnico = new \App\adm\Models\helper\ModelsEmailUnico();
		$valEmailUnico->valEmailUnico($this->dados['email']);
		if (($valEmailUnico->getResult()) and ($valEmail->getResult())) {
			$this->inserirGrafica();
		} else {
			$this->result = false;
		}
	}

	private function inserirGrafica() {
		$slugImg = new \App\adm\Models\helper\ModelsSlug();
		$this->dados['imagem'] = $slugImg->nomeSlug($this->foto['name']);
		if (empty($this->foto['name'])) {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Gráfica não foi cadastrada! Necessário inserir uma imagem!\" });</script>";
			$this->result = false;
		} else {
			$cadGrafica = new \App\adm\models\helper\ModelsCreate();
			$cadGrafica->exeCreate("graficas", $this->dados);
			if ($cadGrafica->getResult()) {
				$this->dados['id'] = $cadGrafica->getResult();
				$this->valFoto();
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Gráfica não foi cadastrada!\" });</script>";
				$this->result = false;
			}
		}
	}

	private function valFoto() {
		$uploadImg = new \App\adm\models\helper\ModelsUploadImgRed();
		$uploadImg->uploadImagem($this->foto, 'assets/img/graficas/' . $this->dados['id'] . '/', $this->dados['imagem'], 350, 220);
		if ($uploadImg->getResult()) {
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Gráfica cadastrada com sucesso!\" });</script>";
			$this->result = true;
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Gráfica não cadastrada! Imagem inválida!\" });</script>";
			$this->result = false;
		}
	}

	function getResult() {
		return $this->result;
	}

}
