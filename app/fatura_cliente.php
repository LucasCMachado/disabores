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
$page = 'cliente';
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
                <h4 class="title">Clientes</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-2">
                    <div class="bloco" id="novo_cliente" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                        <span data-notify="icon" id="icone_cliente" class="pe-7s-plus"></span>
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
                <div class="row" id="forms_clientes" style="display: none">
                <div class="col-md-12">
                    <form method='post' id='cliente-SaveForm' action="#" role="form">
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Nome do cliente *</label> 
                          <input type="text" name="nome" id="nome" class="form-control" placeholder="Insira seu nome completo" required=""> 
                        </div>
                    </div>
                    <div class="col-md-3">       
                        <div class="form-group"> 
                          <label class="control-label">E-mail *</label> 
                          <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu email" required="">
                        </div>
                    </div>
                    <div class="col-md-3">       
                        <div class="form-group"> 
                          <label class="control-label">Senha *</label> 
                          <input type="password" name="senha" id="senha" class="form-control" placeholder="Insira sua senha">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Formade pagamento *</label> 
                          <input type="text" name="forma_pagamento" id="forma_pagamento" class="form-control" placeholder="Insira a forma de pagamento do cliente" required=""> 
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Salvar</button>
                        </div>
                    </div>
                    </form>
                    <!-- Edit Form -->
                    <form method='post' id='cliente-UpdateForm' action="#" role="form" style="display: none">
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Nome do cliente *</label> 
                          <input type="text" name="edit_nome" id="edit_nome" class="form-control" placeholder="Insira o nome do cliente" required=""> 
                        </div>
                    </div>
                    <div class="col-md-3">       
                        <div class="form-group"> 
                          <label class="control-label">E-mail *</label> 
                          <input type="email" name="edit_email" id="edit_email" class="form-control" placeholder="Insira o email do cliente" required="">
                          <input type="hidden" name="edit_id" id="edit_id">
                        </div>                                                                   
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Formade pagamento *</label> 
                          <input type="text" name="edit_forma_pagamento" id="edit_forma_pagamento" class="form-control" placeholder="Insira a forma de pagamento do cliente" required=""> 
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
                        <h4 class="title">clientes</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Forma de pagamento</th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                                require_once './_connect/connect_pdo.php';
                                $dbh = Database::conexao();

                                $stmt = $dbh->prepare('SELECT * FROM cliente ORDER BY nome ASC');
                                $stmt->execute();

                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    echo '
                                    <tr id='.$row["id"].'>
                                        <td>'.$row["nome"].'</td>
                                        <td>'.$row["email"].'</td>
                                        <td>'.$row["forma_pagamento"].'</td>
                                        <td>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" data-email="'.$row["email"].'" data-pagamento="'.$row["forma_pagamento"].'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
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
<script src="assets/forms/cliente_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

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
