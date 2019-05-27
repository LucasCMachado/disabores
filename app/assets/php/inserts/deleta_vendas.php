<?php
ini_set('max_execution_time', 3000);
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	// Fecha vendas

	$stmt0 = $dbh->prepare('SELECT * FROM venda WHERE data_venda >= "2019-04-01"');
    $stmt0->execute();                           

    foreach ($stmt0->fetchAll(PDO::FETCH_ASSOC) as $row1) {                       

	        $idVenda = $row1['id'];
	        echo "ID Venda: ".$idVenda."</br>";

	        deletaVendaProdutos($dbh, $idVenda);
	        deletaVenda($dbh, $idVenda);
    }

    function deletaVendaProdutos($dbh, $idVenda){
		$stmt2 = $dbh->prepare("DELETE FROM vendas_produtos WHERE id_venda=:idVenda");
		$stmt2->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
		$stmt2->execute();
	}

    function deletaVenda($dbh, $idVenda){
    	$stmt3 = $dbh->prepare("DELETE FROM venda WHERE id=:idVenda");
	    $stmt3->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
	    $stmt3->execute();
    }
    
?>