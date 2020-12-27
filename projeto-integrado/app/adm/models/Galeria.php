<?php

namespace App\Adm\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Galeria {

	private $limiteResultado = 40;
	private $result;

	public function listarPost() {
		$listarPost = new \App\adm\Models\helper\ModelsRead();
		$listarPost->exeReadEspecifico(
			"SELECT p.id, p.titulo, p.descricao
			FROM post p
			ORDER BY p.id DESC 
			LIMIT :limit", "&limit={$this->limiteResultado}");
		$this->result = $listarPost->getResult();
		return $this->result;
	}

	public function verPost($id) {
		$this->id = (int) $id;
		$verPerfil = new \App\adm\Models\helper\ModelsRead();
		$verPerfil->exeReadEspecifico(
			"SELECT p.*, ta.descricao tipo_art, u.nome username
            FROM post p, tipo_arte ta, usuario u
            WHERE p.id =:id 
				AND ta.id = p.tipo_arte 
				AND u.id = p.usuario 
				LIMIT :limit", "id={$this->id}&limit=1");
		$this->result = $verPerfil->getResult();
		return $this->result;
	}

	public function apagarPost($id = null) {
		$this->id = (int) $id;
		$this->confirmarPost();
		if ($this->dados) {
			$apagarPost = new \App\adm\Models\helper\ModelsDelete();
			$apagarPost->exeDelete("post", "WHERE id =:id", "id={$this->id}");
			if ($apagarPost->getResult()) {
				$apagarImg = new \App\adm\Models\helper\ModelsDelete();
				$apagarImg->apagarImg('assets/img/galeria/'.$this->id.'/'.$this->dados[0]['imagem'], 'assets/img/galeria/'.$this->id);
				$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Post excluído com sucesso!\" });</script>";
				$this->result = true;
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Post não excluído!\" });</script>";
				$this->result = false;
			}
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Post não excluído!\" });</script>";
			$this->result = false;
		}
	}

	public function confirmarPost() {
		$verPost = new \App\adm\Models\helper\ModelsRead();
		$verPost->exeReadEspecifico(
			"SELECT p.imagem 
			FROM post p
			WHERE p.id = :id 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->dados = $verPost->getResult();
	}

}
