<?php
namespace ConexaoPHPPostgres;
printf("sin \n a");
//Classe que realiza a conexao com o banco de dados
class Connection {
    private static $conn;

    public function connect(){
        echo(' a.0 ');

    
        $servername = "us-cdbr-east-05.cleardb.net";
        $database = "heroku";
        $username = "bc721df62a39bf";
        $password = "bd4ca0ae";
        echo(' b.0 ');
        // Create connection
         $pdo = mysqli_connect($servername, $username, $password);
        // mysqli_select_db($database);
        echo(' c.0 ');
        // Check connection
        if (!$pdo) {
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
