<?php

namespace Config;

class ConfigController {

    private $url;
    private $urlConjunto;
    private $urlController;
    private $urlMetodo;
    private static $formato;
    private $class;
    private $paginas;

    public function __construct() {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            // LIMPA A URL
            $this->clearUrl();
            // SEPARA OS VALORES EM ARRAY
            $this->urlConjunto = explode("/", $this->url);
            // TRATA O CONTROLLER
            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->prepararController($this->urlConjunto[0]);
            } else {
                $this->urlController = CONTROLLER;
            }
            // TRATA O MÉTODO
            if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->urlConjunto[1];
            } else {
                $this->urlMetodo = "index";
            }
            // TRATA O PARÂMETRO
            if (isset($this->urlConjunto[2])) {
                $this->urlParametro = $this->urlConjunto[2];
            } else {
                $this->urlParametro = null;
            }
        } else {
            $this->urlController = CONTROLLER;
            $this->urlMetodo = METHOD;
            $this->urlParametro = null;
        }
    }

    public function carregar() {
        $listarPg = new \App\site\models\Pagina();
        $this->paginas = $listarPg->listarPaginas($this->urlController, $this->urlMetodo);
        if ($this->paginas) {
            $this->class = "\\App\\{$this->paginas[0]['tipo_tpg']}\\controllers\\" . $this->urlController;
            if (class_exists($this->class)) {
                $this->carregarMetodo();
            } else {
                $this->urlController = ERROR404;
                $this->carregar();
            }
        } else {
            $this->urlController = ERROR404;
            $this->urlMetodo = "index";
            $this->carregar();
        }
    }

    private function clearUrl() {
        // ELEMINA AS TAGS
        $this->url = strip_tags($this->url);
        // ELIMINA ESPAÇOS
        $this->url = trim($this->url);
        // ELIMINA BARRA NO FINAL
        $this->url = rtrim($this->url, "/");

        self::$formato = array();
        self::$formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode(self::$formato['a']), self::$formato['b']);
    }

    public function prepararController($urlController) {
        $urlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($urlController)))));
        return $urlController;
    }

    private function carregarMetodo() {
        $classLoad = new $this->class;
        if (method_exists($classLoad, $this->urlMetodo)) {
            if ($this->urlParametro !== null) {
                $classLoad->{$this->urlMetodo}($this->urlParametro);
            } else {
                $classLoad->{$this->urlMetodo}();
            }
        } else {
            $this->urlController = CONTROLLER;
            $this->urlMetodo = METHOD;
            $this->carregar();
        }
    }

}
