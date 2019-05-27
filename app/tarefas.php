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
$page = 'tarefas';
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
                <h4 class="title">Tarefas</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-2">
                    <div class="bloco" id="novo_tarefa" style="cursor: pointer">
                        <div class="alert alert-info alert-with-icon">
                        <span data-notify="icon" id="icone_tarefa" class="pe-7s-plus"></span>
                            <span>Novo</span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row" id="forms_tarefas" style="display: none">
                <div class="col-md-12">
                    <form method='post' id='tarefa-SaveForm' action="#" role="form">
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Nome do tarefa *</label> 
                          <input type="text" name="nome" id="nome" class="form-control" placeholder="Insira o nome da tarefa" required=""> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Data *</label> 
                          <input type="text" name="data" id="data" class="form-control date" placeholder="Insira a data de realização da tarefa" required=""> 
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Salvar</button>
                        </div>
                    </div>
                    </form>
                    <!-- Edit Form -->
                    <form method='post' id='tarefa-UpdateForm' action="#" role="form" style="display: none">
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Nome do tarefa *</label> 
                          <input type="text" name="edit_nome" id="edit_nome" class="form-control" placeholder="Insira o nome do tarefa" required=""> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                          <label class="control-label">Data *</label> 
                          <input type="text" name="edit_data" id="edit_data" class="form-control date" placeholder="Insira a data de realização da tarefa" required="">
                          <input type="text" name="edit_id" id="edit_id" hidden=""> 
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
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover mdl-data-table" id="tabela_<?php echo $page?>" cellspacing="0" width="100%">
                            <thead>
                                <th>Status</th>
                                <th>Nome</th>
                                <th>Data</th>
                                <th>Opções</th>
                            </thead>
                            <tbody id="tabela">
                            <?php 
                                require_once './_connect/connect_pdo.php';
                                $dbh = Database::conexao();

                                $stmt = $dbh->prepare('SELECT * FROM tarefa ORDER BY data ASC');
                                $stmt->execute();

                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    if ($row['status'] == "concluido") {
                                        $status_icone = '<button class="btn btn-success btn-fill" style="font-size: 30px;padding: 0 15px;"><i class="pe-7s-check"></i></button>';
                                    }else {
                                        $status_icone = '<button class="btn btn-warning btn-fill" style="font-size: 30px;padding: 0 15px;"><i class="pe-7s-stopwatch"></i></button>';
                                    }

                                    echo '
                                    <tr id='.$row["id"].'>
                                        <td>'.$status_icone.'</td>
                                        <td>'.$row["nome"].'</td>
                                        <td>'.inverteData($row["data"]).'</td>
                                        <td>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" data-data="'.inverteData($row["data"]).'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" id="'.$row["id"].'" data-name="'.$row["nome"].'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>';
                                }
                                function inverteData($data){
                                    if(count(explode("/",$data)) > 1){
                                        return implode("-",array_reverse(explode("/",$data)));
                                    }elseif(count(explode("-",$data)) > 1){
                                        return implode("/",array_reverse(explode("-",$data)));
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
<?php include 'config_table.php'; ?>

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
