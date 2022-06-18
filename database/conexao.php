<?php
namespace ConexaoPHPPostgres;

//Classe que realiza a conexao com o banco de dados
class Connection {
    private static $conn;

    public function connect(){
    
        $servername = "us-cdbr-east-05.cleardb.net";
        $database = "heroku_4665f34856c16d8";
        $username = "bc721df62a39bf";
        $password = "bd4ca0ae";
        
        // Create connection
        $pdo = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$pdo) {
            die("Connection failed: " . mysqli_connect_error());
        }else{
            //  echo " Connected successfully ";
            $query = "SELECT * FROM heroku_4665f34856c16d8.editora;";
	
	        $result = mysqli_query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        echo $row['Cod_editora'];
                        echo $row['Nome'];
                        echo $row['Endereco'];
                        echo $row['Telefone'];
                   
                }
            }
            
            
            return $pdo;
        }
        
        
    }

    /**
     * retorna uma instancia da coneccao do banco de dados
     * @return type
     */
    public static function get() {       
        if (null == static::$conn) {
            static::$conn = new static();
        }
        return static::$conn;
    }
}
