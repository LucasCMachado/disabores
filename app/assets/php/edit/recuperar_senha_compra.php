<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();


if(!empty($_POST))
{
        $id = $_POST['id_cl'];
        $senha_compra = $_POST['senha_compra'];
        $senha_compra_hash = password_hash($senha_compra, PASSWORD_DEFAULT);
        
        $stmt = $dbh->prepare("UPDATE cliente SET senha_compra=:senha_compra WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":senha_compra", $senha_compra_hash, PDO::PARAM_STR);
        
        if($stmt->execute())
        {
         echo "sucesso";
        }
        else{
         echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
        }
}

?>