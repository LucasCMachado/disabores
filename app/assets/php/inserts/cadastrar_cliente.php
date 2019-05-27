<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();
    
    if($_POST)
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if (!empty($senha)) {
           $senha_hasheada = password_hash($senha, PASSWORD_DEFAULT);
        }
        $forma_pagamento = $_POST["forma_pagamento"];
        $token = password_hash($email, PASSWORD_DEFAULT);
        $status = "ATIVO";
        
        
        try{
            
            $stmt = $dbh->prepare("INSERT INTO cliente(nome, email, senha, forma_pagamento, token, status) VALUES(:nome, :email, :senha, :forma_pagamento, :token, :status)");
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha_hasheada, PDO::PARAM_STR);
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
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Obrigado por ser mais um de nossos clientes!</p>
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Pensando em sua maior comodidade estamos desenvolvendo uma área especial para você, uma área onde você poderá consultar os valor das suas compras já feitas na Cantina e entrar em contato conosco mesmo de qualquer local.</p>
                <p style="font-family: Arial, sans-serif; font-size: 15px; color: #212121; line-height: 10px; font-weight: 100;">Como essa área irá demonstrar dados pessoais (compras) ele necessita que você defina uma senha para seu acesso.</p>

                <a href="http://app.disabores.com.br/senha_cliente.php?token='.$token.'" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 10px; font-weight: 100;">Clique aqui para definir sua senha.</a>
                <hr>
                <P style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; color: #012742;; line-height: 40px; font-weight: 100;">Menssagem enviada pelo Cantina DiSabores</P>';


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

                $last_id = $dbh->lastInsertId();
                echo '<tr>
                        <td>'.$nome.'</td>
                        <td>'.$email.'</td>
                        <td>'.$forma_pagamento.'</td>
                        <td>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" data-email="'.$email.'" data-pagamento="'.$forma_pagamento.'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>';
            }
            else{
                echo "Ouve um problema no cadastro, por favor tente mais tarde.";
            }   
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>