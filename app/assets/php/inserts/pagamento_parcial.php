<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$data = date("Y-m-d");
$id = $_POST['id_cl'];
$valor_pago = $_POST['valor_pago'];

try {

$stmt2 = $dbh->prepare('INSERT INTO pagamentos_parciais(id_cliente, data, valor_pago) VALUES(:id_cliente, :data, :valor_pago)');
$stmt2->bindParam("id_cliente", $id, PDO::PARAM_INT);
$stmt2->bindParam("data", $data, PDO::PARAM_STR);
$stmt2->bindParam("valor_pago", $valor_pago, PDO::PARAM_STR);

	if ($stmt2->execute()) {
		echo "sucesso";
	}
}
catch(PDOException $e){
    echo $e->getMessage();
}

?>