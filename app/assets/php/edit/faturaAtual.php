<?php 
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$id = $_POST['cliente_id'];
$data_faturamento = date('Y-m');

$stmt = $dbh->prepare('SELECT SUM(valor_total) AS valorFatura FROM venda WHERE id_cliente=:id_cliente AND data_venda LIKE "'.$data_faturamento.'%"');
$stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_faturado = number_format($row['valorFatura'], 2, '.', ','); // retorna valor formatado

echo $total_faturado;

?>