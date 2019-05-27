<!doctype html>
<html lang="en">
<head>
<?php
include("_head.html");
?>
</head>
<body>

<div class="wrapper">
<?php 
$page = 'orcamentos';
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
                <h4 class="title">Cadastros</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-2">
                    <a href="novo-orcamento" class="bloco" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                        <span data-notify="icon" id="icone_cliente" class="pe-7s-plus"></span>
                            <span>Novo</span>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-2">
                    <a href="orcamentos" class="bloco" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                        <span data-notify="icon" id="icone_cliente" class="pe-7s-unlock"></span>
                            <span>Abertos</span>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Orcamentos entregues</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped mdl-data-table" id="tabela_orcamentos" cellspacing="0" width="100%">
                            <thead>
                                <th>Nome</th>
                                <th>Dados de contato</th>
                                <th>Forma de pagamento</th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                                require_once './_connect/connect_pdo.php';
                                $dbh = Database::conexao();

                                $stmt = $dbh->prepare('SELECT * FROM orcamentos WHERE status="ENTREGUE" ORDER BY data_entrega ASC');
                                $stmt->execute();

                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    echo '
                                    <tr id='.$row["id"].'>
                                        <td>'.$row["nome_contratante"].'</td>
                                        <td>'.$row["email"].' - '.$row["telefone"].'</td>
                                        <td>'.inverteData($row["data_entrega"]).'</td>
                                        <td>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome_contratante"].'" data-email="'.$row["email"].'" data-pagamento="'.$row["telefone"].'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            </button>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome_contratante"].'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                                <i class="fa fa-times"></i>
                                            </button>                                            
                                        </td>
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
<script src="assets/forms/orcamento_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.js"></script>

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