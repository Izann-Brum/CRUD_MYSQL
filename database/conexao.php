<?php
namespace ConexaoPHPPostgres;
print("sin \n a");
//Classe que realiza a conexao com o banco de dados
class Connection {
    private static $conn;

    public function connect(){
        echo(' a.0 ');

        // // Le os parametros do banco do dados -> database.ini
        // $params = parse_ini_file('database.ini');
        // if ($params === false) {
        //     throw new \Exception("Error reading database configuration file");   
        // }
        // // Conecta ao postgres
        //  $conStr = sprintf("pgsql:host=%s;dbname=%s;user=%s;password=%s", 
        //         $params['host'], 
        //         $params['database'], 
        //         $params['user'], 
        //         $params['password']);
    
        $servername = "us-cdbr-east-05.cleardb.net";
        $database = "heroku";
        $username = "bc721df62a39bf";
        $password = "bd4ca0ae";
        echo(' a.0 ');
        // Create connection
        $pdo = mysqli_connect($servername, $username, $password) or die ("html>script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)/script>/html>");
        mysqli_select_db($dbname);
        echo(' b.0 ');
        // Check connection
        if (!$pdo) {
            echo('Connection failed');
            die("Connection failed: " . mysqli_connect_error());
        }else{
            echo " Connected successfully ";
            return $pdo;
        }
        
    }

    /**
     * retorna uma instancia da coneccao do banco de dados
     * @return type
     */
    public static function get() {
        echo(' g.0 ');
       
        if (null == static::$conn) {
            static::$conn = new static();
           echo(' g.y ');
        }
        return static::$conn;
    }
}
