<?php
namespace ConexaoPHPPostgres;

//Classe que realiza a conexao com o banco de dados
class Connection {
    private static $conn;

    public function connect(){

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
        $database = "heroku_9ef729a7f1a0fc6";
        $username = "bc1acac5643b4f";
        $password = "ab603c47";

        // Create connection
        $pdo = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$pdo) {
            echo('Connection failed');
            die("Connection failed: " . mysqli_connect_error());
        }else{
            // echo " Connected successfully ";
            return $pdo;
        }
        
    }

    /**
     * retorna uma instancia da coneccao do banco de dados
     * @return type
     */
    public static function get() {
       
        if (null === static::$conn) {
            static::$conn = new static();
           
        }
        return static::$conn;
    }
}
