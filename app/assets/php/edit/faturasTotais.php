<?php 

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$id = $_REQUEST['cliente_id'];
$status = 'PENDENTE';

$stmt = $dbh->prepare('SELECT id, valor_total, data, multa, juros FROM faturas WHERE id_cliente=:cliente_id AND status=:status');
$stmt->bindParam(":cliente_id", $id, PDO::PARAM_INT);
$stmt->bindParam(":status", $status, PDO::PARAM_STR);
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

    $valorTotal = $row['valor_total']+$row['multa']+$row['juros'];

    $faturas[] = array(
		'id_fatura' => $row['id'],
		'valor_fatura' => $row['valor_total'],
        'valor_total' => number_format($valorTotal, 2,'.', ''),
        'multa' => $row['multa'],
        'juros' => $row['juros'],
		'data_fatura' => inverteData($row['data'])
	);
}

echo( json_encode( $faturas ) );

function inverteData($data_inverte){
        if(count(explode("/",$data_inverte)) > 1){
            return implode("-",array_reverse(explode("/",$data_inverte)));
        }elseif(count(explode("-",$data_inverte)) > 1){
            return implode("/",array_reverse(explode("-",$data_inverte)));
        }
    }
?>