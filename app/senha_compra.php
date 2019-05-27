<!DOCTYPE html>
<!-- saved from url=(0085)http://demos.creative-tim.com/light-bootstrap-dashboard-pro/examples/pages/login.html -->
<html lang="en" class="perfect-scrollbar-on">
<head>
<?php 
include("_head.html"); 
?>
<?php 
    require_once './_connect/connect_pdo.php';
    $dbh = Database::conexao();

    $token = $_GET['token']; 
    $stmt=$dbh->prepare("SELECT email FROM cliente WHERE token=:token");
    $stmt->execute(array(':token'=>$token));  
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<style>
html, body {
height: 100%;
min-height: 100%;
background-image: url('./assets/img/fundo.jpg');
background-repeat: no-repeat;
background-size: cover;
background-position: center center;
}
.wrapper {
height: 100%;
min-height: 100%;
display: -webkit-flex;
display: flex;
-webkit-align-items: center;
align-items: center;
-webkit-justify-content: center;
justify-content: center;
background-color: rgba(138, 109, 59, 0.6);

}

.wrapper form {
width: 100%;
height: 100%;
}
#bg {
position: fixed; 
top: -50%; 
left: -50%; 
width: 200%; 
height: 200%;
z-index: -1;

}
#bg img {
position: absolute; 
top: 0; 
left: 0; 
right: 0; 
bottom: 0; 
margin: auto; 
min-width: 50%;
min-height: 50%;
}
</style>
</head>
<body> 

<div class="wrapper">       
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
    <div class="content">
        <div class="container">
            <div class="row">                   
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <form method="POST" id="senha_compra-SaveForm" action="#" role="form">                        
                    <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                        <div class="card">
                            <div class="header text-center">
                                <p>Cadastre sua senha</p>
                                <span>A senha deverá conter somente númerais </span>
                                <span>e apenas 4 digitos.</span>
                            </div>
                            <div class="content">                                
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" placeholder="Insira o email" value="<?php echo $row['email']?>" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" name="senha" placeholder="Insira a senha" class="form-control senha num" required="">
                                </div>
                                <div class="form-group">
                                    <label>Confirmar senha</label>
                                    <input type="password" placeholder="Insira novamente a senha" class="form-control senha num" required="">
                                </div>                                    
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-fill btn-warning btn-wd" style="margin-bottom: 15px;">Entrar</button>
                            </div>
                        </div>
                            
                    </form>
                            
                </div>                    
            </div>
        </div>
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

<!--  Notifications -->
<script src="assets/js/notify.js"></script>

<!-- Forms -->
<script src="assets/forms/compra_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('.num').mask('0000');
    });
</script>
    
<div class="sweet-container"><div class="sweet-overlay" tabindex="-1"></div><div class="sweet-alert" style="display: none" tabindex="-1"><div class="icon error"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info"></div> <div class="icon success"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <img class="sweet-image"> <h2>Title</h2><div class="sweet-content">Text</div><hr class="sweet-spacer"><button class="sweet-confirm">OK</button><button class="sweet-cancel">Cancel</button></div></div></body></html>