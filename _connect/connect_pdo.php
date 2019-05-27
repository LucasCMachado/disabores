<?php

/**

 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.

 * Modo de Usar:

 * require_once './Database.class.php';

 * $dbh = Database::conexao();

 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $dbh.

 */

class Database

{

    # Variável que guarda a conexão PDO.

    protected static $dbh;

    # Private construct - garante que a classe só possa ser instanciada internamente.

    private function __construct()

    {

        # Informações sobre o banco de dados:

        //$db_host = "photocontrole.mysql.dbaas.com.br";
        
        $db_host = "disabores.mysql.dbaas.com.br";

        $db_nome = "disabores";

        $db_usuario = "disabores";

        $db_senha = "diSabores10";

        $db_driver = "mysql";



        # Informações sobre o sistema:

        $sistema_titulo = "Disabores";

        $sistema_email = "lucascesar@uorksis.com";

        try

        {

            # Atribui o objeto PDO à variável $dbh.

            self::$dbh = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);

            # Garante que o PDO lance exceções durante erros.

            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Garante que os dados sejam armazenados com codificação UFT-8.

            self::$dbh->exec('SET NAMES utf8');

        }

        catch (PDOException $e)

        {

            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.

            mail($sistema_email, "PDOException em $sistema_titulo", $e->getMessage());

            # Então não carrega nada mais da página.

            die("Connection Error: " . $e->getMessage());

        }

    }

    # Método estático - acessível sem instanciação.

    public static function conexao()

    {

        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.

        if (!self::$dbh)

        {

            new Database();

        }

        # Retorna a conexão.

        return self::$dbh;

    }

}