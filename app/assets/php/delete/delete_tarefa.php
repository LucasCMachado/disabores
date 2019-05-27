<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if($_POST['del_id'])
{
	$id = $_POST['del_id'];

	$stmt=$dbh->prepare("DELETE FROM tarefa WHERE id=:id");
	$stmt->bindParam(":id", $id);
    $stmt->execute();	
}
?>