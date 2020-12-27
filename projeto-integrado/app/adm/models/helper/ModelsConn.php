<?php

namespace App\adm\models\helper;

use PDO;
use PDOException;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class ModelsConn {

	public static $host = HOST;
	public static $dbname = DBNAME;
	public static $user = USER;
	public static $pass = PASS;
	public static $conexao = null;

	private static function conectar() {
		try {
			if (self::$conexao == null) {
				self::$conexao = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname . ";charset=utf8", self::$user, self::$pass);
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			die;
		}
		self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$conexao;
	}

	public function getConn() {
		return self::conectar();
	}

}
