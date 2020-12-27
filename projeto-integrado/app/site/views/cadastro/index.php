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
			$nome = $email = "";
		} else {
			extract($this->dados['formRetorno']);
		}
		?>
		<form name="forCadastro" method="post" action="">
			<div class="cad-box">
				<h1>Cadastro</h1>
				<div class="textbox">
					<i class="fas fa-user"></i>
					<input type="text" name="nome" id="iNome" value="<?= $nome ?>" placeholder="Nome de Usuário">
				</div>
				<div class="textbox rowm">
					<i class="fas fa-envelope"></i>
					<input type="email" name="email" id="iEmail" value="<?= $email ?>" placeholder="Seu melhor E-mail">
				</div>
				<div class="textbox">
					<i class="fas fa-lock"></i>
					<input type="password" name="senha" id="iSenha" placeholder="Senha">
				</div>
				<div class="textbox">
					<i class="fas fa-lock"></i>
					<input type="password" name="rsenha" id="iRepassword" placeholder="Reescreva sua Senha">
				</div>
				<input type="submit" class="button" name="formAddUsuario" value="Cadastrar">
				<p class="link">
					Já tem conta?
					<a href="<?= URL ?>Auth/Auth">Ir para Login</a>
				</p>
			</div>
		</form>
	</div>

</main>