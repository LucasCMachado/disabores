<?php
require_once '../../../_connect/connect_pdo.php';

if($_POST['pag_id'])
{
	$id_fatura = $_POST['idFatura'];
	$status = "PAGO";

	function select_dados($id_fat)
	{

	$dbh = Database::conexao();
	$sql = 'SELECT cliente.nome, cliente.email as "email_cliente", faturas.valor_total, faturas.data FROM faturas LEFT JOIN cliente ON faturas.id_cliente=cliente.id WHERE faturas.id=:id';
	$sth = $dbh->prepare($sql);
	$sth->bindValue(':id', $id_fat);
	$sth->execute();
	$dados = $sth->fetch();

	$data = date('m/Y');

		$message = '
		<P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; font-weight: 100;">Olá '.$dados["nome"].'</P>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">O pagamento referente a sua fatura na Cantina DiSabores no valor de R$ '.$dados["valor_total"].' e com vencimento para 10/'.$data.' foi confirmado.</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Não se esqueça que você pode visualizar esta fatura na Área do Cliente em nosso site.</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Este é um e-mail automático. Se ficou com alguma dúvida, fale com a gente pelos canais de atendimento.</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; font-weight: 100;">Até logo!</p>
		<hr>
		<P style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; color: #012742;; line-height: 40px; font-weight: 100;">Equipe DiSabores</P>';

	    return array ($message, $dados['email_cliente']);
	}

	function email($message_send, $mail){

		$corpo_email = $message_send;
		$email_cliente = $mail;

		$quebra_linha = "\n";
		$emailsender='contato@disabores.com.br';
		$nomeremetente     = 'Cantina DiSabores';
		$emailremetente    = 'contato@disabores.com.br';
		$emaildestinatario = $email_cliente;
		$comcopia          = "";
		$comcopiaoculta    = "";
		$assunto           = "Confirmação de pagamento";
		$data = date('m/Y');

		// Montando a mensagem a ser enviada no corpo do e-mail.
		$mensagemHTML = $corpo_email;

		// Montando o cabeçho da mensagem 
		$headers = "MIME-Version: 1.1".$quebra_linha;
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		// Perceba que a linha acima conté"text/html", sem essa linha, a mensagem nãchegaráormatada.
		$headers .= "From: ".$emailsender.$quebra_linha;
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		$headers .= "Cc: ".$comcopia.$quebra_linha;
		$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
		// Note que o e-mail do remetente serásado no campo Reply-To (Responder Para)

		// Enviando a mensagem 
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);

		echo 'sucesso';
	}

	list ($mensagem, $email_destinatario) = select_dados($id_fatura);

	$dbh = Database::conexao();
	$stmt = $dbh->prepare("UPDATE faturas SET status=:status WHERE id=:id");
	$stmt->bindParam(":id", $id_fatura, PDO::PARAM_INT);
	$stmt->bindParam(":status", $status, PDO::PARAM_STR);    

    if ($stmt->execute()) {
    	$send_mail = email($mensagem, $email_destinatario);
    }

}
?>