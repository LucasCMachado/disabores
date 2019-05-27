<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$stmt = $dbh->prepare('SELECT * FROM cliente WHERE status = "ATIVO" && senha_compra = ""');
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

	$nome_cliente = $row['nome'];
	$email_cliente = $row['email'];
	$token = $row['token'];

	$quebra_linha = "\n";
	$emailsender='contato@disabores.com.br';
	$nomeremetente     = 'Cantina DiSabores';
	$emailremetente    = 'contato@disabores.com.br';
	$emaildestinatario = $email_cliente;
	$comcopia          = "";
	$comcopiaoculta    = "";
	$assunto           = "COMUNICADO IMPORTANTE";

	/* Montando a mensagem a ser enviada no corpo do e-mail. */
	$mensagemHTML = '

	<P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; font-weight: 100;">Olá '.$nome_cliente.'</P>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Está tudo bem?</p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Gostaríamos de informar que a partir do dia 10/07/2017 somente será possivel realizar compras na Cantina DiSabores com a inserção de uma senha de confirmação.
	</p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Por conta da necessidade de confirmação por senha, o tempo de espera poderá ser um pouco maior que o habitual.</p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Gostaríamos de informar também que a compra de doces que antes eram feitas de forma anotada e depois passada para o sistema não irá mais acontecer devido a confirmação da venda através da senha cadastrada.</p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Abaixo segue o link para que você possa cadastrar sua senha!</p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;"><a href="http://app.disabores.com.br/senha_compra.php?token='.$token.'" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 10px; font-weight: 100; background: #F53C56; padding: 10px; color: #FFFFFF; text-decoration: none;border-radius: 4px;">Cadastre sua senha aqui</a></p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Este é um e-mail automático. Se ficou com alguma dúvida, fale conosco pelos canais de atendimento.</p>
	<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; font-weight: 100;">Até logo!</p>
	<hr>
	<P style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; color: #012742;; line-height: 40px; font-weight: 100;">Equipe DiSabores</P>';


	/* Montando o cabeçho da mensagem */
	$headers = "MIME-Version: 1.1".$quebra_linha;
	$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
	// Perceba que a linha acima conté"text/html", sem essa linha, a mensagem nãchegaráormatada.
	$headers .= "From: ".$emailsender.$quebra_linha;
	$headers .= "Return-Path: " . $emailsender . $quebra_linha;
	$headers .= "Cc: ".$comcopia.$quebra_linha;
	$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
	$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
	// Note que o e-mail do remetente serásado no campo Reply-To (Responder Para)

	/* Enviando a mensagem */
	mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);

	echo "sucesso";
}
?>