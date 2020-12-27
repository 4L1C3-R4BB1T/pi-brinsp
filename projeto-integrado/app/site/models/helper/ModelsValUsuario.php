<?php

namespace App\site\models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsValUsuario {

    private $usuario;
    private $result;
    private $editarUnico;
    private $id;

    public function valUsuario($usuario, $editarUnico = null, $id = null) {
        $this->usuario = (string) $usuario;
        $this->editarUnico = $editarUnico;
        $this->id = $id;
        $valUsuario = new \App\adm\Models\helper\ModelsRead();
        if (!empty($this->editarUnico) and ($this->editarUnico == true)) {
            $valUsuario->exeReadEspecifico("SELECT id FROM usuario WHERE nome =:usuario AND id <>:id LIMIT :limit", "usuario={$this->usuario}&limit=1&id={$this->id}");
        } else {
            $valUsuario->exeReadEspecifico("SELECT id FROM usuario WHERE nome =:usuario LIMIT :limit", "usuario={$this->usuario}&limit=1");
        }
        $this->result = $valUsuario->getResult();
        if (!empty($this->result)) {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: este nome de usuário já está cadastrado!\" });</script>";
            $this->result = false;
        } else {
            $this->valCaracterUsuario();
        }
    }

    private function valCaracterUsuario() {
        if (stristr($this->usuario, "'")) {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Caracter ( ' ) utilizado no usuário inválido!\" });</script>";
            $this->result = false;
        } else {
            if (stristr($this->usuario, " ")) {
                $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Proibido utilizar espaço em branco no usuário!\" });</script>";
                $this->result = false;
            } else {
                $this->valTamUsuario();
            }
        }
    }

    private function valTamUsuario() {
        if ((strlen($this->usuario)) < 3) {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: O usuário deve ter no mínimo 3 caracteres!\" });</script>";
            $this->result = false;
        } else {
            $this->result = true;
        }
    }

    function getResult() {
        return $this->result;
    }
    
}
