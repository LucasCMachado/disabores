<?php 

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$id_cliente = $_POST['cliente_id'];
$dataLocal = inverteData($_POST['data_fatura']);
$dataLocal = substr($dataLocal, 0, -3);

$stmt = $dbh->prepare('SELECT SUM(valor_pago) as valorTotal FROM pagamentos_parciais LEFT JOIN cliente ON cliente.id=pagamentos_parciais.id_cliente WHERE pagamentos_parciais.id_cliente=:id_cliente && pagamentos_parciais.data LIKE "'.$dataLocal.'%"');
$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
$stmt->execute();
$totalVenda = $stmt->fetch();

if ($totalVenda['valorTotal']>0) {
    echo 'R$ '.number_format($totalVenda['valorTotal'],2,",","");
}else{
    echo 'Nenhum pagamento parcial encontrado';
}

function inverteData($data_inverte){
        if(count(explode("/",$data_inverte)) > 1){
            return implode("-",array_reverse(explode("/",$data_inverte)));
        }elseif(count(explode("-",$data_inverte)) > 1){
            return implode("/",array_reverse(explode("-",$data_inverte)));
        }
    }
?>