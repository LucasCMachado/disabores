<?php

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

try{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (!empty($_POST['senha'])) {

        $senha = $_POST['senha'];
        $senha_hasheada = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $dbh->prepare('UPDATE cliente SET nome=:nome, email=:email, senha=:senha WHERE id=:id');
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha_hasheada, PDO::PARAM_STR);

        if($stmt->execute()){
            echo "sucesso";
        }
        else{
            echo "erro";
        }

    }else {

        $stmt = $dbh->prepare('UPDATE cliente SET nome=:nome, email=:email WHERE id=:id');
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        if($stmt->execute()){
            echo "sucesso";
        }
        else{
            echo "erro";
        }
    }
}catch(PDOException $e){
 echo $e->getMessage();
}
?>