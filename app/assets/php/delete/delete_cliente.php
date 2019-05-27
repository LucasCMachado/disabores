<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if($_POST['del_id'])
{
	$id = $_POST['del_id'];
	$status = "INATIVO";

	$stmt = $dbh->prepare("UPDATE cliente SET status=:status WHERE id=:id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	$stmt->bindParam(":status", $status, PDO::PARAM_STR);
    $stmt->execute();	
}
?>