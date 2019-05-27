<!doctype html>
<html lang="en">
<head>
<?php
include("_head.html"); 
?>
<style type="text/css">
  @media print { 
      .notprint { visibility:hidden; }
      .notoverflow{ overflow: hidden; }
  }
</style>
</head>
<body>

<div class="wrapper">
<?php 
$page = 'relatorios';
include("_sidebar.php");
?>

<div class="main-panel">

<?php 
include("_navbar.php");
?>            


<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Relatório de faturas: <b><?php echo $_POST["mes_desejado"]; ?></b></h4>
                <div class="content">
                    <button class="btn btn-info btn-fill notprint " onClick="window.print()">Imprimir</button>
                </div>                
            </div>            
        </div>
        <div class="row" id="yesprint">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover mdl-data-table" id="tabela_<?php echo $page?>" cellspacing="0" width="100%">
                            <thead>
                                <th>Cliente</th>
                                <th>Fechamento</th>
                                <th>Valor Total</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                            include_once '_connect/connect_pdo.php';
                            $dbh = Database::conexao();

                            $mes_atual = inverteData($_POST["mes_desejado"]);

                            try{

                            $stmt1 = $dbh->prepare('SELECT * FROM faturas WHERE data LIKE "'.$mes_atual.'%" AND status="PENDENTE" ORDER BY nome ASC');
                            $stmt1->execute();                           

                            foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                echo '
                                <tr>
                                    <td>'.$row["nome"].'</td>
                                    <td>'.inverteData($row["data"]).'</td>
                                    <td>R$'.$row["valor_total"].'</td>
                                    <td>'.$row["status"].'</td>
                                    <td><button type="button" id="'.$row["id_cliente"].'" data-name="'.$row["nome"].'" class="btn btn-info btn-fill enviar-email">E-mail Cliente</button>
                                    <button type="button" id="'.$row["id_cliente"].'" data-name="'.$row["nome"].'" class="btn btn-info btn-fill enviar-email-rh">Cobrança RH</button></td>
                                </tr>';
                            }

                            }
                            catch(PDOException $e){
                                echo $e->getMessage();
                            }

                            function inverteData($data_inverte){
                                if(count(explode("/",$data_inverte)) > 1){
                                    return implode("-",array_reverse(explode("/",$data_inverte)));
                                }elseif(count(explode("-",$data_inverte)) > 1){
                                    return implode("/",array_reverse(explode("-",$data_inverte)));
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="footer notprint">
    <div class="container-fluid">
     <p class="copyright pull-right">
        &copy; 2016 <a href="http://www.uorksis.com">Uorksis</a>
    </p>
</div>
</footer>

</div>
</div>
</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/notify.js"></script>
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/forms/cliente_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<!-- Data Table -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.material.min.js"></script>
<?php include 'config_table.php'; ?>

<script>
    jQuery(document).ready(function($) {
        $('.money').mask('000.00', {reverse: true});
        $('#novo_cliente').on('click', function(event) {
        $('#cliente-UpdateForm').css({
            'display': 'none'
        });$('#cliente-SaveForm').css({
            'display': 'block'
        });
        $('#forms_clientes').toggle( "slow" );
        $('#nome').focus();
        });
    });
</script>

</html>