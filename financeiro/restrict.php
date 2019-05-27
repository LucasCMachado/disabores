<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();
$pagina = "restrito";
// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
	if($pagina == "restrito"){
		// Destrói a sessão por segurança
		session_destroy();
		header("Location: login");
	}
	  // Destrói a sessão por segurança
	session_destroy();
}
?>