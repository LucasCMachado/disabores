<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();


if(!empty($_POST))
{
        $id = $_POST['edit_id'];
        $nome = $_POST['edit_nome'];
        $email = $_POST['edit_email'];
        $forma_pagamento = $_POST["edit_forma_pagamento"];
        $token = password_hash($email, PASSWORD_DEFAULT);
        $status = "ATIVO";
        
        $stmt = $dbh->prepare("UPDATE cliente SET nome=:nome, email=:email, forma_pagamento=:forma_pagamento, token=:token, status=:status WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":forma_pagamento", $forma_pagamento, PDO::PARAM_STR);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        
        if($stmt->execute())
        {
                
                        // Cria uma variável que terá os dados do erro
                // Passando os dados obtidos pelo formuláo para as variáis abaixo
                $last_id = $dbh->lastInsertId();
                $quebra_linha = "\n";
                $emailsender='contato@disabores.com.br';
                $nomeremetente     = $nome;
                $emailremetente    = $email;
                $emaildestinatario = "$email";
                $comcopia          = "";
                $comcopiaoculta    = "";
                $assunto           = "Criação de usuário";
                
                /* Montando a mensagem a ser enviada no corpo do e-mail. */
                $mensagemHTML = '

                <P style="font-family: Arial, sans-serif; font-size: 20px; color: #012742; line-height: 10px; font-weight: 100;">Olá!</P>
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Recentemente houve uma alteração em seu cadastro</p>
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
        else{
                echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
        }
}

?>