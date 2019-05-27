<!doctype html>
<html lang="en">
<head>
<?php
include("_head.html"); 
?>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
</head>
<body>

<div class="wrapper">
<?php 
$page = 'cardapio';
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
                <h4 class="title">Selecione o dia da Semana</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-info btn-fill dia" data-dia="Segunda"><i class="pe-7s-refresh-2"></i> Segunda</button>
                        <button class="btn btn-info btn-fill dia" data-dia="Terça"><i class="pe-7s-refresh-2"></i> Terça</button>
                        <button class="btn btn-info btn-fill dia" data-dia="Quarta"><i class="pe-7s-refresh-2"></i> Quarta</button>
                        <button class="btn btn-info btn-fill dia" data-dia="Quinta"><i class="pe-7s-refresh-2"></i> Quinta</button>
                        <button class="btn btn-info btn-fill dia" data-dia="Sexta"><i class="pe-7s-refresh-2"></i> Sexta</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Editar Cardápio</h4>
                    </div>
                    <div class="content">
                        <form method='post' id='cardapio-UpdateForm' action="#" role="form">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Dia da semana selecionado</label>
                                        <input type="text" class="form-control" id="dia_semana" name="dia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Informe o cardápio do dia</label>
                                        <textarea class="form-control" id="cardapio" name="cardapio" value=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-fill pull-left">Salvar</button>
                            <div class="clearfix"></div>
                        </form>
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

<!--  Notifications Plugin    -->
<script src="assets/js/notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/forms/cardapio_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        $('.dia').on('click', function(event) {
            $('#dia_semana').attr('value', $(this).data('dia'));            
        });
    });
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'cardapio' );
</script>

</html>
