<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$status=0;

$stmt = $dbh->prepare('SELECT id_cliente FROM faturas WHERE status = "PENDENTE"');
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

        $stmt2 = $dbh->prepare("UPDATE cliente SET status_conta=:status WHERE id=:id");
        $stmt2->bindParam(":id", $row['id_cliente'], PDO::PARAM_INT);
        $stmt2->bindParam(":status", $status, PDO::PARAM_STR);

        if($stmt2->execute())
        {
        echo "Cadastro editado com sucesso.";
        }
        else{
        echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
        }

}


?>