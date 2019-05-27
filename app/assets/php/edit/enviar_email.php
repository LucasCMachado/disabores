<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if(!empty($_POST))
{
$stmt = $dbh->prepare('SELECT * FROM cliente');
$stmt->execute();                           

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

// Cria uma variável que terá os dados do erro
// Passando os dados obtidos pelo formuláo para as variáis abaixo

$quebra_linha = "\n";
$emailsender='contato@disabores.com.br';
$nomeremetente     = $row['nome'];
$emailremetente    = $row['email'];
$emaildestinatario = $row['email'];
$comcopia          = "";
$comcopiaoculta    = "";
$assunto           = $_POST['assunto'];
$mensagem           = $_POST['mensagem'];

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
mail($emaildestinatario, $assunto, $mensagem, $headers, "-r". $emailsender);

echo "sucesso";
}

}

?>