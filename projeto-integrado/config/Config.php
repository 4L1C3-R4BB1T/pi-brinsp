<?php
// INICIALIZANDO A SESSÃO
session_start(); 
// LIMPA O BUFFER DE REDIRECIONAMENTO
ob_start(); 

// URL PADRÃO DO SITE
define('URL', 'http://127.0.0.1/pi-brinsp/projeto-integrado/');
define('URLADM', 'http://127.0.0.1/pi-brinsp/projeto-integrado/adm/');

// CONTROLLER E MÉTODOS PADRÃO
define('CONTROLLER', 'Home');
define('METHOD', 'index');
define('ERROR404', 'Error404');

// DADOS DE ACESSO AO BD
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'brinsp_db');
