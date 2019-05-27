<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if($_POST['del_id'])
{
	$id = $_POST['del_id'];

	$stmt=$dbh->prepare("DELETE FROM vendas_produtos_temp WHERE id_venda=:id");
	$stmt->bindParam(":id", $id);
    $stmt->execute();

    $stmt2=$dbh->prepare("DELETE FROM venda_temp WHERE id=:id");
	$stmt2->bindParam(":id", $id);
    $stmt2->execute();	
}
?>