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
            <?php 
            include_once '_connect/connect_pdo.php';
            $dbh = Database::conexao();

            $id = $_POST["cliente"];

            try{

            $mes_atual = date('Y-m');
            $stmt = $dbh->prepare('SELECT nome FROM cliente WHERE id=:id_cliente');
            $stmt->bindParam(":id_cliente", $id, PDO::PARAM_STR);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);                           

            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
            ?>
                <h4 class="title">Relatório de vendas cliente: <b><?php echo $row['nome']?></b></h4>
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
                                <th>Periodo da venda</th>
                                <th>Data da venda</th>
                                <th>Produtos</th>
                                <th>Valor</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                            include_once '_connect/connect_pdo.php';
                            $dbh = Database::conexao();

                            $id = $_POST["cliente"];

                            try{
                            $valorTotalMensal = 0;

                            $mes_atual = date('Y-m');
                            $stmt1 = $dbh->prepare('SELECT venda.id as "idVenda", venda.data_venda as "dataVenda", venda.valor_total as "valor", periodo.nome as "nomePeriodo" FROM venda LEFT JOIN cliente ON cliente.id=venda.id_cliente LEFT JOIN periodo ON periodo.id=venda.id_periodo WHERE venda.id_cliente=:id_cliente && venda.data_venda LIKE "'.$mes_atual.'%" ORDER BY venda.data_venda');
                            $stmt1->bindParam(":id_cliente", $id, PDO::PARAM_STR);
                            $stmt1->execute();                           

                            foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                $idVenda = $row['idVenda'];
                                $valorTotalMensal = $valorTotalMensal + $row['valor'];

                                $stmt2 = $dbh->prepare("SELECT * FROM produto LEFT JOIN vendas_produtos ON vendas_produtos.id_produto=produto.id WHERE vendas_produtos.id_venda=:id_venda");
                                $stmt2->execute(array(':id_venda'=>$idVenda));                      
                                $stmt2->execute();
                                while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
                                {
                                    $lista_produtos[] = $row2['nome'];
                                }

                                echo '
                                <tr>
                                    <td>'.$row["nomePeriodo"].'</td>
                                    <td>'.inverteData($row["dataVenda"]).'</td>
                                    <td>'.implode(", ", $lista_produtos).'</td>
                                    <td>R$'.$row["valor"].'</td>
                                </tr>';
                                unset($lista_produtos);
                            }
                            echo '<tr style="background: #999999; color: #FFF">
                                    <td><b>VALOR TOTAL</b></td>
                                    <td></td>
                                    <td></td>
                                    <td> R$ '.$valorTotalMensal.'</td>
                                </tr>';

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
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/forms/cliente_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>
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