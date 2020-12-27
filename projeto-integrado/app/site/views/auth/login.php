<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<div class="container marketing">
		<?php
		if (isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		if (!isset($this->dados['formRetorno'])) {
			$email = "";
		} else {
			extract($this->dados['formRetorno']);
		}
		?>
		<form name="forLogin" method="post" action="">
			<div class="login-box">
				<h1>Login</h1>
				<div class="textbox">
					<i class="fas fa-envelope"></i>
					<input type="text" placeholder="E-mail" name="email" id="iEmail" value="<?= $email ?>" required>
				</div>
				<div class="textbox">
					<i class="fas fa-lock"></i>
					<input type="password" placeholder="Senha" name="senha" id="iSenha" required>
				</div>
				<input type="submit" class="button" name="sendLogin" value="Entrar">
				<p class="link">
					Ainda não tem conta?
					<a href="<?= URL ?>Cadastro/index">Cadastre-se</a>
				</p>
			</div>
		</form>
	</div>

</main>