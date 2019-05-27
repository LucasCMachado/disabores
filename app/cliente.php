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
                        <table class="table table-hover table-striped mdl-data-table" id="tabela_cliente" cellspacing="0" width="100%">
                            <thead>
                                <th>Nome</th>
                                <th></th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela"> 
                            <?php 
                                require_once './_connect/connect_pdo.php';
                                $dbh = Database::conexao();

                                $stmt = $dbh->prepare('SELECT * FROM cliente WHERE status = "ATIVO" ORDER BY nome ASC');
                                $stmt->execute();

                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    echo '
                                    <tr>
                                        <td>'.$row["nome"].'</td>
                                        <td></td>
                                        <td style="text-align: right;">
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" data-email="'.$row["email"].'" data-pagamento="'.$row["forma_pagamento"].'" class="btn btn-primary btn-fill edit-link">Editar</button>

                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" data-email="'.$row["email"].'" data-pagamento="'.$row["forma_pagamento"].'" class="btn btn-primary btn-fill senha-compra-link">Senha</button>

                                            <button type="button" id="'.$row["id"].'" class="btn btn-primary btn-fill listaPag-total" data-toggle="modal" data-target="#faturas">Pag. Fatura</button>

                                            <button type="button" id="'.$row["id"].'" data-atual="'.date('d/m/Y').'" class="btn btn-primary btn-fill listaPag-parcial">Pag. Parcial</button>';

                                            if ($row["status_conta"]>0) {
                                                echo '<button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" style="margin-left: 3px;" class="btn btn-primary btn-fill disabled desbloquear">Desbloquear</button>';
                                            }else{
                                                echo '<button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" style="margin-left: 3px;" class="btn btn-primary btn-fill desbloquear">Desbloquear</button>';
                                            }
                                            echo'
                                            <button type="button" id="'.$row["id"].'" class="btn btn-danger btn-fill delete-link">Deletar</button>
                                                                                      
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

<div class="modal fade modal-mini modal-primary" id="faturas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">                            
            <h4> Faturas disponíveis</h4>
            </div>
            <div class="modal-body text-center" id="faturasTotaisPagamento">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-defaut btn-fill" data-dismiss="modal">Cancelar</button>
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

<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.js"></script>

<!-- Data Table -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.material.min.js"></script>
<?php include 'config_table.php'; ?>
<script>
    jQuery(document).ready(function($) {
        $('.money').mask('000.00', {reverse: true});
        $('.num').mask('0000');
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