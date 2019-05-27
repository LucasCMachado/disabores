<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if($_POST['fecha_id'])
{
	$id = $_POST['fecha_id'];
	// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
	// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $data_fechamento = date("Y/m/d");
    $hora_fechamento = date('H:i:s');
    $valor_total = "";
	$status = "fechado";

	// Fecha vendas

	$stmt0 = $dbh->prepare('SELECT * FROM venda_temp ORDER BY id DESC');
    $stmt0->execute();                           

    foreach ($stmt0->fetchAll(PDO::FETCH_ASSOC) as $row1) {                       

	        $idPeriodo = $row1['id_periodo'];
	        $idCliente = $row1['id_cliente'];
	        $dataVenda = $row1['data_venda'];
	        $horaVenda = $row1['hora_venda'];

	        $stmt2 = $dbh->prepare("INSERT INTO venda(id_periodo, id_cliente, data_venda, hora_venda) VALUES(:periodo, :cliente, :data, :hora)");
	        $stmt2->bindParam(":periodo", $idPeriodo, PDO::PARAM_INT);
	        $stmt2->bindParam(":cliente", $idCliente, PDO::PARAM_INT);
	        $stmt2->bindParam(":data", $dataVenda, PDO::PARAM_STR);
	        $stmt2->bindParam(":hora", $horaVenda, PDO::PARAM_STR);
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

    //Fecha periodo

	try{
		$stmt5 = $dbh->prepare("UPDATE periodo SET status=:status WHERE id=:id");
		$stmt5->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt5->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt5->execute();

		$stmt6 = $dbh->prepare("UPDATE controle_periodo SET data_fechamento=:data_fechamento, hora_fechamento=:hora_fechamento, valor_total=:valor_total");
	    $stmt6->bindParam(":data_fechamento", $data_fechamento, PDO::PARAM_STR);
	    $stmt6->bindParam(":hora_fechamento", $hora_fechamento, PDO::PARAM_STR);
	    $stmt6->bindParam(":valor_total", $valor_total, PDO::PARAM_STR);
		
		if($stmt6->execute())
		{
			$last_id = $dbh->lastInsertId();

			$stmt = $dbh->prepare("DELETE FROM vendas_temp");
			$stmt->execute();

			$stmt = $dbh->prepare("DELETE FROM vendas_produtos_temp");
			$stmt->execute();

			echo $last_id;
		}
		else{
			echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
		}
	}
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>