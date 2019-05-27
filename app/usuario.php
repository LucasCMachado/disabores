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
$page = 'usuarios';
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
                <h4 class="title">Usuários</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-2">
                    <div class="bloco" id="novo_usuario" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                        <span data-notify="icon" id="icone_usuario" class="pe-7s-plus"></span>
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
                <div class="row" id="forms_usuarios" style="display: none">
                <div class="col-md-12">
                    <form method='post' id='usuario-SaveForm' action="#" role="form">
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Nome do usuario *</label> 
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Salvar</button>
                        </div>
                    </div>
                    </form>
                    <!-- Edit Form -->
                    <form method='post' id='usuario-UpdateForm' action="#" role="form" style="display: none">
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Nome do usuario *</label> 
                          <input type="text" name="edit_nome" id="edit_nome" class="form-control" placeholder="Insira o nome do usuario" required=""> 
                        </div>
                    </div>
                    <div class="col-md-3">       
                        <div class="form-group"> 
                          <label class="control-label">E-mail *</label> 
                          <input type="email" name="edit_email" id="edit_email" class="form-control" placeholder="Insira o email do usuario" required="">
                          <input type="hidden" name="edit_id" id="edit_id">
                        </div>                                                                   
                    </div>
                    <div class="col-md-3">       
                        <div class="form-group"> 
                          <label class="control-label">Senha *</label> 
                          <input type="password" name="edit_senha" id="edit_senha" class="form-control" placeholder="Insira sua senha">
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
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover mdl-data-table" id="tabela_usuarios" cellspacing="0" width="100%">
                            <thead>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                                require_once './_connect/connect_pdo.php';
                                $dbh = Database::conexao();

                                $stmt = $dbh->prepare('SELECT * FROM usuario ORDER BY nome ASC');
                                $stmt->execute();

                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    echo '
                                    <tr id='.$row["id"].'>
                                        <td>'.$row["nome"].'</td>
                                        <td>'.$row["email"].'</td>
                                        <td>'.$row["status"].'</td>
                                        <td>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" data-email="'.$row["email"].'" data-status="'.$row["status"].'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
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
<script src="assets/forms/usuario_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.material.min.js"></script>
<?php include 'config_table.php'; ?>

<script>
    jQuery(document).ready(function($) {
        $('#novo_usuario').on('click', function(event) {
        $('#usuario-UpdateForm').css({
            'display': 'none'
        });$('#usuario-SaveForm').css({
            'display': 'block'
        });
        $('#forms_usuarios').toggle( "slow" );
        $('#nome').focus();
        });
    });
</script>

</html>
