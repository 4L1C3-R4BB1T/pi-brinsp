<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class User {

	private $tabela = 'usuario';
	private $result;

	public function addCom(array $dados) {
		$this->dados = $dados;
		$this->dados['remetente'] = (int) $_SESSION['usuario_id'];
        $this->dados['data_envio'] = date("Y-m-d");
		$this->exeAddCom();
	}

	private function exeAddCom() {
		$inserir = new \Site\models\helper\ModelsCreate();
		$inserir->exeCreate('mensagem', $this->dados);
		if ($inserir->getResult()) {
			$this->result = true;
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Comentário realizado com sucesso!\" });</script>";
		}
	}

	public function visualizarUser($user = null) {
		$this->user = $user;
		$visualizar = new \Site\models\helper\modelsRead();
		$visualizar->exeReadEspecifico(
			"SELECT *
            FROM {$this->tabela} u               
            WHERE u.id = :iduser 
            LIMIT :limit", "iduser={$this->user}&limit=1");
		$this->result['user'] = $visualizar->getResult();
		return $this->result['user'];
	}

	public function visualizarCom($user = null) {
		$this->user = $user;
		$visualizar = new \Site\models\helper\modelsRead();
		$visualizar->exeReadEspecifico(
			"SELECT m.*, u.nome, u.imagem
            FROM mensagem m, usuario u               
            WHERE m.destinatario = :iduser 
				AND	 u.id = m.remetente
			ORDER BY m.data_envio DESC
            LIMIT :limit", "iduser={$this->user}&limit=5");
		$this->result['user'] = $visualizar->getResult();
		return $this->result['user'];
	}

	public function altUsuario(array $dados) {
		$this->dados = $dados;
		$this->foto = $this->dados['imagem_nova'];
		$this->imgAntiga = $this->dados['imagem_antiga'];
		unset($this->dados['imagem_nova'], $this->dados['imagem_antiga']);
		$valCampoVazio = new \App\site\models\helper\ModelsCampoVazio();
		$valCampoVazio->validarDados($this->dados);
		if ($valCampoVazio->getResult()) {
			$this->valCamposAlterar();
		} else {
			$this->result = false;
		}
	}

	private function valCamposAlterar() {
		$valUsuario = new \App\site\models\helper\ModelsValUsuario();
		$editarUnico = true;
		$valUsuario->valUsuario($this->dados['nome'], $editarUnico, $this->dados['id']);
		if ($valUsuario->getResult()) {
			$this->valFotoAlterar();
		} else {
			$this->result = false;
		}
	}

	private function valFotoAlterar() {
		if (empty($this->foto['name'])) {
			$this->updateEditUsuario();
		} else {
			$slugImg = new \App\site\models\helper\ModelsSlug();
			$this->dados['imagem'] = $slugImg->nomeSlug($this->foto['name']);
			$uploadImg = new \App\site\models\helper\ModelsUploadImg();
			$uploadImg->uploadImagem($this->foto, 'assets/img/usuario/', $this->dados['imagem']);
			if ($uploadImg->getResult()) {
				$apagarImg = new \App\site\models\helper\ModelsApagarImg();
				$apagarImg->apagarImg('assets/img/usuario/' . $this->imgAntiga);
				$this->updateEditUsuario();
			} else {
				$this->result = false;
			}
		}
	}

	private function updateEditUsuario() {
		$upAltSenha = new \Site\models\helper\ModelsUpdate();
		$upAltSenha->exeUpdate("usuario", $this->dados, "WHERE id =:id", "id=" . $this->dados['id']);
		if ($upAltSenha->getResult()) {
			$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Usuário atualizado com sucesso!\" });</script>";
			$this->result = true;
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Usuáiro não atualizado!\" });</script>";
			$this->result = false;
		}
	}

	function getResult() {
		return $this->result;
	}
	
}
