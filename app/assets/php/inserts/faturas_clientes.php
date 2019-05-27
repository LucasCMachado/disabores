<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$data_incio = mktime(0, 0, 0, date('m')-1 , 1 , date('Y'));
$data_fim = mktime(23, 59, 59, date('m'), date('d')-date('j'), date('Y'));

$data_faturamento = date('Y-m',$data_incio);
$data_banco = date('Y-m-d', $data_fim);

$status = 'PENDENTE';

$stmt = $dbh->prepare('SELECT * FROM cliente WHERE status = "ATIVO"');
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

	$stmt2 = $dbh->prepare('SELECT SUM(valor_total) AS valorFatura FROM venda WHERE id_cliente=:id_cliente AND data_venda LIKE "'.$data_faturamento.'%"');
	$stmt2->bindParam(":id_cliente", $row["id"], PDO::PARAM_INT);
	$stmt2->execute();
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	$total_faturado = number_format($row2['valorFatura'], 2, '.', ','); // retorna valor formatado

	$stmt3 = $dbh->prepare('SELECT SUM(valor_pago) AS valorParciais FROM pagamentos_parciais WHERE id_cliente=:id_cliente AND data LIKE "'.$data_faturamento.'%"');
	$stmt3->bindParam(":id_cliente", $row["id"], PDO::PARAM_INT);
	$stmt3->execute();
	$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

	$total_parciais = number_format($row3['valorParciais'], 2, '.', ','); // retorna valor formatado

	$valor_receber = $total_faturado - $total_parciais;

	if ($valor_receber>0) {

		$stmt4 = $dbh->prepare("INSERT INTO faturas(id_cliente, nome, valor_total, data, status) VALUES(:id_cliente, :nome, :valor_total, :data, :status)");
		$stmt4->bindParam(":id_cliente", $row["id"], PDO::PARAM_INT);
		$stmt4->bindParam(":nome", $row["nome"], PDO::PARAM_STR);
		$stmt4->bindParam(":valor_total", $valor_receber, PDO::PARAM_STR);
		$stmt4->bindParam(":data", $data_banco, PDO::PARAM_STR);
		$stmt4->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt4->execute();

		$stmt5 = $dbh->prepare('SELECT nome, email FROM cliente WHERE id=:id_cliente');
		$stmt5->bindParam(":id_cliente", $row["id"], PDO::PARAM_INT);
		$stmt5->execute();
		$row4 = $stmt5->fetch(PDO::FETCH_ASSOC);

		$nome_cliente = $row4['nome'];
		$email_cliente = $row4['email'];

		$quebra_linha = "\n";
		$emailsender='contato@disabores.com.br';
		$nomeremetente     = 'Cantina DiSabores';
		$emailremetente    = 'contato@disabores.com.br';
		$emaildestinatario = $email_cliente;
		$comcopia          = "";
		$comcopiaoculta    = "";
		$assunto           = "Relacionamento DiSabores";
		$data = date('m/Y');

		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = '

		<P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; font-weight: 100;">Olá '.$nome_cliente.'</P>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Está tudo bem?</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Gostaríamos de informar que a sua fatura com vencimento para 10/'.$data.' e no valor de R$ '.$valor_receber.' já está disponivel para pagamento.</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Para realizar o pagamento de sua fatura basta passar no balcão de nosso estabelecimento e conversar com um de nossos atendentes.</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Não se esqueça: Pagamentos feitos após o dia 10 de cada mês são acrescidos de juros e multa.</p>
		<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Este é um e-mail automático. Se ficou com alguma dúvida, fale com a gente pelos canais de atendimento.</p>
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
	}else{
		echo 'Fatura zerada';
	}

	
}
?>