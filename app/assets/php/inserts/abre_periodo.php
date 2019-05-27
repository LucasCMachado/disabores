<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

if($_POST['abre_id'])
{
	$id = $_POST['abre_id'];
	$data_abertura = date("Y/m/d");
	// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
	// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $hora_abertura = date('H:i:s');
    $data_fechamento = "";
    $hora_fechamento = "";
    $valor_total = "";
	$status = "aberto";

	try{

		$stmt=$dbh->prepare("SELECT id FROM periodo WHERE status = 'aberto'");
    	$stmt->execute();

    	$per_Abertos = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		$total = count($per_Abertos); 

		if ($total < 1) {
			$stmt2 = $dbh->prepare("UPDATE periodo SET status=:status WHERE id=:id");
			$stmt2->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt2->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt2->execute();

			$stmt3 = $dbh->prepare("INSERT INTO controle_periodo(data_abertura, hora_abertura, data_fechamento, hora_fechamento, id_periodo) VALUES(:data_abertura, :hora_abertura, :data_fechamento, :hora_fechamento, :id_periodo)");
		    $stmt3->bindParam(":data_abertura", $data_abertura, PDO::PARAM_STR);
		    $stmt3->bindParam(":hora_abertura", $hora_abertura, PDO::PARAM_STR);
		    $stmt3->bindParam(":data_fechamento", $data_fechamento, PDO::PARAM_STR);
		    $stmt3->bindParam(":hora_fechamento", $hora_fechamento, PDO::PARAM_STR);
		    $stmt3->bindParam(":id_periodo", $id, PDO::PARAM_INT);
			
			if($stmt3->execute())
			{
				//$last_id = $dbh->lastInsertId();
				echo "aberto";
			}
			else{
				echo "problema";
			}
		}else {

			echo "fechar";
		}

		
	}
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>