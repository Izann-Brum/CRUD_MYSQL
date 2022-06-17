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
                
    
        $servername = "localhost";
        $database = "id19084403_bancosbd777";
        $username = "id19084403_adm";
        $password = "SQt3)Lf>{C^!W\#X";

        // Access Credentials Heroku
        // Username:	bc1acac5643b4f
        // Password:	ab603c47

        // Create connection
        $pdo = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$pdo) {
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