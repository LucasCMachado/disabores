<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();


if(!empty($_POST))
{
$id = $_POST['id'];

$sql = 'SELECT email FROM cliente WHERE id=:codigo';
$sth = $dbh->prepare($sql);
$sth->bindValue(':codigo', $id);
$sth->execute();
$email = $sth->fetch();

$stmt1 = $dbh->prepare('SELECT * FROM faturas WHERE id_cliente=:id AND status="PENDENTE" LIMIT 1');
$stmt1->bindParam(":id", $id, PDO::PARAM_INT);
$stmt1->execute();                           

foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {

// Cria uma variável que terá os dados do erro
// Passando os dados obtidos pelo formuláo para as variáis abaixo

$last_id = $dbh->lastInsertId();
$quebra_linha = "\n";
$emailsender='contato@disabores.com.br';
$nomeremetente     = $nome;
$emailremetente    = $email;
$emaildestinatario = $email['email'];
$comcopia          = "";
$comcopiaoculta    = "";
$assunto           = "Relacionamento DiSabores";
$data = date('m/Y');

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '

<P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; font-weight: 100;">Olá '.$row["nome"].'</P>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Está tudo bem?</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Este mês, o pagamento referente a sua fatura na Cantina DiSabores no valor de R$ '.$row["valor_total"].' e com vencimento para 10/'.$data.' está atrasado.</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Sabemos que imprevistos acontecem, mas em virtude desse atraso sua conta ficará bloqueada temporariamente para compras até o pagamento da fatura.</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Se já fez o pagamento, por favor, desconsidere este e-mail, ok?</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Mas se não, saiba que você pode visualizar esta fatura na área do Cliente em nosso site.</p>
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
}

}

?>