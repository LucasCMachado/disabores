<div class="sidebar" data-color="blue" data-image="assets/img/fundo.jpg">

<div class="sidebar-wrapper">
        <div class="logo">
            <a class="simple-text">
                DiSabores
            </a>
        </div>

        <ul class="nav">
        <?php 
            if ($page == 'inicio') {
                echo '<li class="active">';
            }else{
                echo '<li>';
            }
        ?>
                <a href="inicio">
                    <i class="pe-7s-graph"></i>
                    <p>Inicio</p>
                </a>
            </li>
            <?php 
                if ($page == 'periodo') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="periodos">
                    <i class="pe-7s-cart"></i>
                    <p>Períodos</p>
                </a>
            </li>
            <?php 
                if ($page == 'produto') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="produto">
                    <i class="pe-7s-piggy"></i>
                    <p>Produtos</p>
                </a>
            </li>
            <?php 
                if ($page == 'cliente') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="cliente">
                    <i class="pe-7s-id"></i>
                    <p>Clientes</p>
                </a>
            <?php 
                if ($page == 'relatorios') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="relatorios">
                    <i class="pe-7s-display1"></i>
                    <p>Relatórios</p>
                </a>
            <?php 
                if ($page == 'tarefas') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="tarefas">
                    <i class="pe-7s-note2"></i>
                    <p>Tarefas</p>
                </a>
            <?php 
                if ($page == 'usuarios') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="usuarios">
                    <i class="pe-7s-user"></i>
                    <p>Usuários</p>
                </a>
            <?php 
                if ($page == 'cardapio') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="cardapio">
                    <i class="pe-7s-bookmarks"></i>
                    <p>Cardápio</p>
                </a>
            <?php 
                if ($page == 'orcamentos') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="orcamentos">
                    <i class="pe-7s-notebook"></i>
                    <p>Orçamentos</p>
                </a>
            <?php 
                if ($page == 'email') {
                    echo '<li class="active">';
                }else{
                    echo '<li>';
                }
            ?>
                <a href="email">
                    <i class="pe-7s-mail"></i>
                    <p>Email</p>
                </a>
            </li>
        </ul>
	</div>
</div>