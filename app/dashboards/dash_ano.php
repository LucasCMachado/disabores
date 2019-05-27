<?php
require_once './_connect/connect_pdo.php';
$dbh = Database::conexao();

date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$data = date("Y");

$totalMes1=0;$totalMes2=0;$totalMes3=0;$totalMes4=0;$totalMes5=0;$totalMes6=0;$totalMes7=0;$totalMes8=0;$totalMes9=0;$totalMes10=0;$totalMes11=0;$totalMes12=0;

$sql3 = 'SELECT data_venda FROM venda WHERE data_venda LIKE "'.$data.'%"';
$sth = $dbh->prepare($sql3);
$sth->execute();

foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

    $mes = substr($row['data_venda'], 5,2);

    if ($mes == '01') {
        $totalMes1 = $totalMes1 + 1;
    }
    if ($mes == '02') {
        $totalMes2 = $totalMes2 + 1;
    }
    if ($mes == '03') {
        $totalMes3 = $totalMes3 + 1;
    }
    if ($mes == '04') {
        $totalMes4 = $totalMes4 + 1;
    }
    if ($mes == '05') {
        $totalMes5 = $totalMes5 + 1;
    }
    if ($mes == '06') {
        $totalMes6 = $totalMes6 + 1;
    }
    if ($mes == '07') {
        $totalMes7 = $totalMes7 + 1;
    }
    if ($mes == '08') {
        $totalMes8 = $totalMes8 + 1;
    }
    if ($mes == '09') {
        $totalMes9 = $totalMes9 + 1;
    }
    if ($mes == '10') {
        $totalMes10 = $totalMes10 + 1;
    }
    if ($mes == '11') {
        $totalMes11 = $totalMes11 + 1;
    }
    if ($mes == '12') {
        $totalMes12 = $totalMes12 + 1;
    }
}
?>