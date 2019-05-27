<?php

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

try{
    $id = $_POST['id_usuario'];

    $senha = $_POST['senha'];
    $senha_hasheada = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $dbh->prepare('UPDATE cliente SET senha_compra=:senha WHERE id=:id');
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":senha", $senha_hasheada, PDO::PARAM_STR);

    if($stmt->execute()){
        echo "sucesso";
    }
    else{
        echo "erro";
    }

}catch(PDOException $e){
 echo $e->getMessage();
}
?>