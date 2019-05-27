<?php

require_once '../../../_connect/connect_pdo.php';

$dbh = Database::conexao();

    

    if($_POST)

    {

        $email = $_POST['email'];

        $senha_compra = $_POST['senha'];

        $senha_hasheada = password_hash($senha_compra, PASSWORD_DEFAULT);        

        

        try{

            

        $stmt = $dbh->prepare("UPDATE cliente SET senha_compra=:senha_compra WHERE email=:email");

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->bindParam(":senha_compra", $senha_hasheada, PDO::PARAM_STR);



            if($stmt->execute())

            {               

                echo 'sucesso';

            }

            else{

                echo "erro";

            }   

        }

        catch(PDOException $e){

            echo $e->getMessage();

        }

    }



?>