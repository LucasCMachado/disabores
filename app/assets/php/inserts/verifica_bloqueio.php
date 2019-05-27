<?php 

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$id=$_POST['id'];

$stmt = $dbh->prepare('SELECT status_conta FROM cliente WHERE id=:id LIMIT 1');
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$resultado=$stmt->fetch();

echo $resultado['status_conta'];
?>