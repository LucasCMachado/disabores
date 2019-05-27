<?php
require_once '../../../_connect/connect_pdo.php'; 
$dbh = Database::conexao();
	
if(!empty($_POST))
{

        $email = $_POST['email_recuperacao'];

        $stmt = $dbh->prepare("SELECT * FROM cliente WHERE email=:email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        	
        $token = $row['token'];
        // Cria uma variável que terá os dados do erro
        // Passando os dados obtidos pelo formuláo para as variáis abaixo
        $quebra_linha = "\n";
        $emailsender='contato@disabores.com.br';
        $emailremetente    = $email;
        $emaildestinatario = "$email";
        $comcopia          = "";
        $comcopiaoculta    = "";
        $assunto           = "Recuperação de usuário";

        /* Montando a mensagem a ser enviada no corpo do e-mail. */
        $mensagemHTML = '

        <P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; line-height: 10px; font-weight: 100;">Olá!</P>
        <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Recentemente houve uma alteração em seu cadastro.</p>
        <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Caso você não tenha solicitado essa alteração, por gentileza entre em contato conosco.</p>
        <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Agora, caso você tenha solicitado essa alteração de senha basta clicar no link abaixo e você será redirecionado para a página de alteração de senha.</p>

        <a href="http://app.disabores.com.br/senha_cliente.php?token='.$token.'" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 10px; font-weight: 100;">Clique aqui para definir sua senha.</a>
        <hr>
        <P style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; color: #012742;; line-height: 40px; font-weight: 100;">Menssagem enviada pela Cantina DiSabores</P>';


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

        	echo "Cadastro editado com sucesso.";
        }
}

?>