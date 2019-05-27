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

$stmt1 = $dbh->prepare('SELECT * FROM faturas WHERE id_cliente=:id LIMIT 1');
$stmt1->bindParam(":id", $id, PDO::PARAM_INT);
$stmt1->execute();                           

foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {

// Cria uma variável que terá os dados do erro
// Passando os dados obtidos pelo formuláo para as variáis abaixo

$quebra_linha = "\n";
$emailsender='contato@disabores.com.br';
$nomeremetente     = $nome;
$emailremetente    = $email;
$emaildestinatario = $email['email'];
$comcopia          = "";
$comcopiaoculta    = "";
$assunto           = "Relacionamento DiSabores";

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '

<P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; font-weight: 100;">Olá '.$row["nome"].'</P>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Está tudo bem?</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Gostaríamos de informar que o pagamento referente a(s) sua(s) fatura(s) na Cantina DiSabores se encontram em atrasado.</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Sabemos que imprevistos acontecem, mas como a situação ainda persiste sua conta estará sendo bloqueada para compras em nosso estabelecimento até o pagamento de sua fatura.</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Caso o pagamento não seja efetuado até dia 30 desse mês, sua conta seré enviada para o setor de RH para desconto em folha.</p>
<p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 1em; font-weight: 100;">Não se esqueça: Pagamentos atrasados de cada mês são acrescidos de juros e multa.</p>
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