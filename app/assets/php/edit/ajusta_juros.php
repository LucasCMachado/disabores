<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$stmt = $dbh->prepare('SELECT * FROM faturas WHERE status="PENDENTE"');
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

	$valor_original=$row["valor_total"];
	$valor_original+=$row["multa"];
	$valor_original+=$row["juros"];
 
	$data1 = new DateTime( substr($row["data"], 0, -3) );
	$data2 = new DateTime( strftime('%Y-%m', strtotime('-1 Month')) );

	$intervalo = $data1->diff( $data2 );
	$anos=$intervalo->y;
	$meses=$intervalo->m;
 
	echo "Cliente: ".$row['nome']."<br>";
	echo "Data: ".substr($row["data"], 0, -3)."<br>";
	echo "Anos: ".$anos." Meses: ".$meses."<br>";
	echo "Valor original: ".$valor_original."<br>";
	
	$multa = 0.02*$valor_original;
	echo "Valor multa: ".$multa."<br>";
	$totalComMulta = $valor_original+$multa;

	echo "Valor c/ multa: ".$totalComMulta."<br>";

	$totalDoJuros=0;
	$juros=0;

	if ($anos >= 1) {
		$meses=$anos*12+$meses;
		echo "Meses Ajustado: ".$meses."<br>";

		for ($i=1; $i < $meses; $i++) {

			if ($i<2) {
				$juros = 0.03*$valor_original;
				echo $juros."B: <br>";
				$totalDoJuros += $juros;
				echo "I: ".$i."<br>";
			}else{
				$juros = 0.03*$totalComMulta;
				echo $juros."B: <br>";
				$totalDoJuros += $juros;
				echo $totalDoJuros."<br>";
				echo "I: ".$i."<br>";
			}	
		}
	}else{

		for ($i=1; $i <= $meses; $i++) {

			if ($i<2) {
				$juros = 0.03*$valor_original;
				echo $juros."B: <br>";
				$totalDoJuros += $juros;
				echo "I: ".$i."<br>";
			}else{
				$juros = 0.03*$totalComMulta;
				echo $juros."B: <br>";
				$totalDoJuros += $juros;
				echo $totalDoJuros."<br>";
				echo "I: ".$i."<br>";
			}	
		}
	}

	$total = number_format($totalDoJuros, 2,'.', '');
	$multa = number_format($multa, 2,'.', '');

	$stmt2 = $dbh->prepare("UPDATE faturas SET multa=:multa, juros=:juros WHERE id=:id");
	$stmt2->bindParam(":multa", $multa);
	$stmt2->bindParam(":juros", $total);
	$stmt2->bindParam(":id", $row["id"]);
	$stmt2->execute();

}

?>