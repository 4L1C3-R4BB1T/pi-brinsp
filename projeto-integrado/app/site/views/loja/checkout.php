<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<?php
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	?>

	<div class="container mt-5 mb-5 pl-5">
		<div class="bill-to">
			<p>Identificação</p>
			<form name="forCheckout" method="post">
				<div class="form">
					<?php
					if (!isset($this->dados['formRetorno'])) {
						$nome = $cpf = $estado = $cidade = $rua = $bairro = $cep = $telefone = "";
					} else {
						extract($this->dados['formRetorno']);
					}
					?>
					<div>
						<input type="text" name="nome" id="iNome" value="<?= $nome ?>" placeholder="Nome Completo">
						<input type="text" name="cpf" id="iCpf" value="<?= $cpf ?>" placeholder="CPF">
						<input type="text" name="estado" id="iEstado" value="<?= $estado ?>" placeholder="Estado">
						<input type="text" name="cidade" id="iCidade" value="<?= $cidade ?>" placeholder="Cidade">
						<input type="text" name="rua" id="iRua" value="<?= $rua ?>" placeholder="Rua">
						<input type="text" name="bairro" id="iBairro" value="<?= $bairro ?>" placeholder="Bairro">
						<input type="text" name="cep" id="iCep" value="<?= $cep ?>" placeholder="CEP">
						<input type="text" name="telefone" id="iTelefone" value="<?= $telefone ?>" placeholder="Telefone">
					</div>
				</div>
				<div class="form">
					<select class="ml-5" name="pagamento" id="iPagamento">
						<option>Método de Pagamento</option>
						<option value=1>Boleto</option>
						<option value=2>Cartão de Crédito</option>
						<option value=3>PayPal</option>
					</select>
					<div class="total_area">
						<ul class="list-unstyled ml-5 mr-2">
							<li>Carrinho Sub Total
								<span>R$<?= $_SESSION['valor'] ?></span>
							</li>
							<li>Taxa de envio
								<span>R$
									<?php
									if (isset($_SESSION['frete'])) {
										echo $_SESSION['frete'];
									} else {
										echo "0";
									}
									?>
								</span>
							</li>
							<li>Total
								<span>R$
									<?php
									if (isset($this->dados['valor'])) {
										echo $this->dados['valor'];
									} else {
										echo "0";
									}
									?>
								</span>
							</li>
						</ul>
					</div>
					<input type="submit" class="btn btn-default update mr-2 float-right" name="formCheckout" value="Confirmar Compra">
				</div>
			</form>
		</div>

		<div class="text-center">
			<img class="imgcheck mt-4" src="<?= URL ?>assets/img/checkout/obrigado">
		</div>
	</div>

</main>