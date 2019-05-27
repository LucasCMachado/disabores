<?php
require_once '../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	
	if(!empty($_POST))
	{

		$nome = $_POST['nome'];
                $email = $_POST['email'];
                $mensagem = $_POST['mensagem'];
					
                // Cria uma variável que terá os dados do erro
                // Passando os dados obtidos pelo formuláo para as variáis abaixo
                $quebra_linha = "\n";
                $emailsender='contato@disabores.com.br';
                $emailremetente    = $email;
                $emaildestinatario = 'contato@disabores.com.br';
                $comcopia          = "";
                $comcopiaoculta    = "";
                $assunto           = "Contato cliente";
               
                /* Montando a mensagem a ser enviada no corpo do e-mail. */
                $mensagemHTML = '

                <P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; line-height: 10px; font-weight: 100;">Contato de clientes</P>
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Nome: '.$nome.'</p>
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">E-mail: '.$email.'</p>
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">E-mail: '.$mensagem.'</p>';


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

			echo "enviado";
	}

?>