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
$page = 'produto'; 
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
                <h4 class="title">Produtos</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-2">
                    <div class="bloco" id="novo_produto" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                        <span data-notify="icon" id="icone_produto" class="pe-7s-plus"></span>
                            <span>Novo</span>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-2">
                    <div class="block" id="relartorios" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                            <span data-notify="icon" class="pe-7s-news-paper"></span>
                            <span>Relatórios</span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row" id="forms_produtos" style="display: none">
                <div class="col-md-12">
                    <form method='post' id='produto-SaveForm' action="#" role="form">
                    <div class="col-md-5">
                        <div class="form-group"> 
                          <label class="control-label">Nome do produto *</label> 
                          <input type="text" name="nome" id="nome" class="form-control" placeholder="Insira o nome do produto" required=""> 
                        </div>
                    </div>
                    <div class="col-md-5">       
                        <div class="form-group"> 
                          <label class="control-label">Valor *</label> 
                          <input type="text" name="valor" id="alor" class="form-control money" placeholder="Insira o valor do produto" required="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Salvar</button>
                        </div>                                                                   
                    </div>
                    </form>
                    <form method='post' id='produto-UpdateForm' action="#" role="form" style="display: none">
                    <div class="col-md-5">
                        <div class="form-group"> 
                          <label class="control-label">Nome do produto *</label> 
                          <input type="text" name="edit_nome" id="edit_nome" class="form-control" placeholder="Insira o nome do produto" required=""> 
                        </div>
                    </div>
                    <div class="col-md-5">       
                        <div class="form-group"> 
                          <label class="control-label">Valor *</label> 
                          <input type="text" name="edit_valor" id="edit_valor" class="form-control money" placeholder="Insira o valor do produto" required="">
                          <input type="hidden" name="edit_id" id="edit_id">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Salvar</button>
                        </div>                                                                   
                    </div>
                    </form>
                </div>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Produtos</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover mdl-data-table" id="tabela_produto" cellspacing="0" width="100%">
                            <thead>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                                require_once './_connect/connect_pdo.php';
                                $dbh = Database::conexao();

                                $stmt = $dbh->prepare('SELECT * FROM produto ORDER BY nome ASC');
                                $stmt->execute();

                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    echo '
                                    <tr id='.$row["id"].'>
                                        <td>'.$row["nome"].'</td>
                                        <td>R$ '.$row["valor"].'</td>
                                        <td>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" data-value="'.$row["valor"].'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>';
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
<script src="assets/forms/produto_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.material.min.js"></script>
<?php include 'config_table.php'; ?>

<script>
    jQuery(document).ready(function($) {
        $('.money').mask('000.00', {reverse: true});
        $('#novo_produto').on('click', function(event) {
        $('#produto-UpdateForm').css({
            'display': 'none'
        });$('#produto-SaveForm').css({
            'display': 'block'
        });
        $('#forms_produtos').toggle( "slow" );
        $('#nome').focus();
        });
    });
</script>

</html>
