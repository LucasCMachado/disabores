<!DOCTYPE html>
<!-- saved from url=(0085)http://demos.creative-tim.com/light-bootstrap-dashboard-pro/examples/pages/login.html -->
<html lang="en" class="perfect-scrollbar-on">
<head>
<?php 
include("_head.html");
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
    <div class="content">
        <div class="container">
            <div class="row">                   
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <form method='post' action="#" id="login-SaveForm" role="form">                        
                        <div class="card">
                            <div class="header text-center">Login</div>
                            <div class="content">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" placeholder="Insira o email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" name="senha" placeholder="Insira a senha" class="form-control">
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
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<script src="assets/js/notify.js"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>



<!-- Forms -->
<script src="assets/forms/login_form.js"></script>

<!-- Light Bootstrap Table Core javascript and methods -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>
    
<div class="sweet-container"><div class="sweet-overlay" tabindex="-1"></div><div class="sweet-alert" style="display: none" tabindex="-1"><div class="icon error"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info"></div> <div class="icon success"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <img class="sweet-image"> <h2>Title</h2><div class="sweet-content">Text</div><hr class="sweet-spacer"><button class="sweet-confirm">OK</button><button class="sweet-cancel">Cancel</button></div></div></body></html>