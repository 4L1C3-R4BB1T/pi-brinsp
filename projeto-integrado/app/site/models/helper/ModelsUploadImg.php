<?php

namespace App\site\models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsUploadImg {

    private $dadosImagem;
    private $diretorio;
    private $nomeImg;
    private $result;
    private $imagem;

    public function uploadImagem(array $imagem, $diretorio, $nomeImg) {
        $this->dadosImagem = $imagem;
        $this->diretorio = $diretorio;
        $this->nomeImg = $nomeImg;
        $this->validarImagem();
    }

    private function validarImagem() {
        switch ($this->dadosImagem['type']) {
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->imagem = imagecreatefromjpeg($this->dadosImagem['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png';
                $this->imagem = imagecreatefrompng($this->dadosImagem['tmp_name']);
                break;
        }
        if ($this->imagem) {
            $this->valDiretorio();
        } else {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: A extensão da imagem é inválida. Selecione uma imagem JPEG ou PNG!\" });</script>";
            $this->result = false;
        }
    }

    private function valDiretorio() {
        if (!file_exists($this->diretorio) && !is_dir($this->diretorio)) {
            mkdir($this->diretorio, 0755);
        }
        $this->realizarUpload();
    }

    private function realizarUpload() {
        if (move_uploaded_file($this->dadosImagem['tmp_name'], $this->diretorio . $this->nomeImg)) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Não foi possível realizar o upload da imagem!\" });</script>";
            $this->result = false;
        }
    }

    function getResult() {
        return $this->result;
    }

}
