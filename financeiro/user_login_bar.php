<!-- user login dropdown start-->
<li class="dropdown text-center">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <img alt="" src="img/cake.png" class="img-circle profile-img thumb-sm">
        <span class="username"><?php echo $_SESSION['UsuarioNome']; ?> </span> <span class="caret"></span>
    </a>
    <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
        <li><a href="logout"><i class="fa fa-sign-out"></i> Sair</a></li>
    </ul>
</li>
<!-- user login dropdown end -->