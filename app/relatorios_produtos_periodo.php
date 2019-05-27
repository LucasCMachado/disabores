<!doctype html>
<html lang="en">
<head> 
<?php
include("_head.html"); 
?>
<style type="text/css">
    .tabela{
        display: none;
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
                <h4 class="title">Relatório de produtos por período</h4><img src="assets/img/Eclipse.gif" width="50px" class="loader">   
                <div class="content">
                    <button class="btn btn-info btn-fill notprint " onClick="window.print()">Imprimir</button>
                </div>                
            </div>            
        </div>
        <div class="row" id="yesprint">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover" id="tabela_<?php echo $page?>" cellspacing="0" width="100%">
                            <thead>
                                <th>Nome</th>
                                <th>Quantidade</th>
                            </thead>
                            <tbody id="tabela" class="tabela">
                            <?php
                            include_once './_connect/connect_pdo.php';
                            $dbh = Database::conexao();

                            $dataInicial = inverteData($_POST["dataInicial"]);
                            $dataFinal = inverteData($_POST["dataFinal"]);

                            $stmt = $dbh->prepare('SELECT id as "idProduto", nome as nomeProduto from produto ORDER BY nome ASC');
                            $stmt->execute();

                                while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

                                $stmt2 = $dbh->prepare('SELECT COUNT(*) AS "totalProdutos" from venda as v LEFT JOIN vendas_produtos as vp ON v.id=vp.id_venda WHERE v.data_venda>=:dataInicial AND v.data_venda<=:dataFinal AND id_produto=:id_produto');
                                $stmt2->bindValue(':dataInicial', $dataInicial);
                                $stmt2->bindValue(':dataFinal', $dataFinal);
                                $stmt2->bindValue(':id_produto', $row['idProduto']);
                                $stmt2->execute();
                                $total = $stmt2->fetch();

                                    echo '<tr>
                                        <td>'.$row["nomeProduto"].'</td>
                                        <td>'.$total["totalProdutos"].'</td>
                                    </tr>';
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


<footer class="footer">
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
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/forms/tarefa_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.material.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.loader').hide();
    $('#tabela_<?php echo $page?>').DataTable();
    $('.tabela').show('slow');
} );
</script>
<script>
    jQuery(document).ready(function($) {
        $('.date').mask('00/00/0000');
        $('#novo_tarefa').on('click', function(event) {
        $('#tarefa-UpdateForm').css({
            'display': 'none'
        });$('#tarefa-SaveForm').css({
            'display': 'block'
        });
        $('#forms_tarefas').toggle( "slow" );
        $('#nome').focus();
        });
    });
</script>

</html>
