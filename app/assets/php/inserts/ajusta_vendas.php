<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

// Fecha vendas

$stmt0 = $dbh->prepare('SELECT * FROM venda_temp ORDER BY id DESC');
$stmt0->execute();                           

foreach ($stmt0->fetchAll(PDO::FETCH_ASSOC) as $row1) {                       

        $idPeriodo = $row1['id_periodo'];
        $idCliente = $row1['id_cliente'];
        $dataVenda = $row1['data_venda'];
        $horaVenda = $row1['hora_venda'];
        $valorTotal = $row1['valor_total'];

        $stmt2 = $dbh->prepare("INSERT INTO venda(id_periodo, id_cliente, data_venda, hora_venda, valor_total) VALUES(:periodo, :cliente, :data, :hora, :total)");
        $stmt2->bindParam(":periodo", $idPeriodo, PDO::PARAM_INT);
        $stmt2->bindParam(":cliente", $idCliente, PDO::PARAM_INT);
        $stmt2->bindParam(":data", $dataVenda, PDO::PARAM_STR);
        $stmt2->bindParam(":hora", $horaVenda, PDO::PARAM_STR);
        $stmt2->bindParam(":total", $valorTotal, PDO::PARAM_STR);
        $stmt2->execute();

        $idUltimaVenda = $dbh->lastInsertId();

        $idVenda = $row1['id'];
        $stmt3 = $dbh->prepare('SELECT * FROM vendas_produtos_temp WHERE id_venda=:id_venda');
        $stmt3->bindParam(":id_venda", $idVenda, PDO::PARAM_INT);
	    $stmt3->execute();                           

	    foreach ($stmt3->fetchAll(PDO::FETCH_ASSOC) as $row2) {

	    	$produto = $row2['id_produto'];
            $valor_almoco = $row2['valor_almoco'];
            $valor_kg = $row2['valor_kg'];

	        $stmt4 = $dbh->prepare("INSERT INTO vendas_produtos(id_produto, id_venda, valor_almoco, valor_kg) VALUES (:produto, :id_venda, :valor_almoco, :valor_kg)");
            $stmt4->bindParam(":produto", $produto, PDO::PARAM_INT);
            $stmt4->bindParam(":id_venda", $idUltimaVenda, PDO::PARAM_INT);
            $stmt4->bindParam(":valor_almoco", $valor_almoco, PDO::PARAM_STR);
            $stmt4->bindParam(":valor_kg", $valor_kg, PDO::PARAM_STR);
            $stmt4->execute();

	    }
}
?>