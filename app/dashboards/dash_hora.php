<?php
require_once './_connect/connect_pdo.php';
$dbh = Database::conexao();

date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$data = date("Y/m/d");

$tempo1=0;$tempo2=0;$tempo3=0;$tempo4=0;$tempo5=0;$tempo6=0;$tempo7=0;$tempo8=0;$tempo9=0;$tempo10=0;

$sql2 = 'SELECT hora_venda FROM venda WHERE data_venda=:data_venda';
$sth = $dbh->prepare($sql2);
$sth->bindValue(':data_venda', $data);
$sth->execute();
foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

    $hora = substr($row['hora_venda'], 0,2);

    if ($hora <= '09') {
        $tempo1 = $tempo1 + 1;
    }
    if ($hora > '09' && $hora <= '10') {
        $tempo2 = $tempo2 + 1;
    }
    if ($hora > '10' && $hora <= '11') {
        $tempo3 = $tempo3 + 1;
    }
    if ($hora > '11' && $hora <= '12') {
        $tempo4 = $tempo4 + 1;
    }
    if ($hora > '12' && $hora <= '13') {
        $tempo5 = $tempo5 + 1;
    }
    if ($hora > '13' && $hora <= '14') {
        $tempo6 = $tempo6 + 1;
    }
    if ($hora > '14' && $hora <= '15') {
        $tempo7 = $tempo7 + 1;
    }
    if ($hora > '15' && $hora <= '16') {
        $tempo8 = $tempo8 + 1;
    }
    if ($hora > '16' && $hora <= '17') {
        $tempo9 = $tempo9 + 1;
    }
    if ($hora > '17' && $hora <= '18') {
        $tempo10 = $tempo10 + 1;
    }
}
?>