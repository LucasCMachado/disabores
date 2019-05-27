<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if($_POST['id_orc'])
{
	$id = $_POST['id_orc'];
	$status = "ENTREGUE";

	$stmt = $dbh->prepare("UPDATE orcamentos SET status=:status WHERE id=:id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	$stmt->bindParam(":status", $status, PDO::PARAM_STR);
    $stmt->execute();
    echo "sucesso";	
}
?>