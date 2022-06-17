<?php

namespace ConexaoPHPPostgres;

class AutorModel{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    
    public function all(){
        $sql = "SELECT DISTINCT Cod_autor, Nome_autor FROM LIVRO_AUTOR;";
        $result = $this->pdo->query($sql);

        $stocks = [];
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_autor' => $row['Cod_autor'],
                'Nome_autor' => $row['Nome_autor'],
            ];
        }
        } else {
            // echo "0 results";
        }
        return $stocks;
    }

    public function autorWithTitle(){
        $sql = "SELECT DISTINCT Cod_autor, Nome_autor, Titulo FROM LIVRO INNER JOIN LIVRO_AUTOR ON Nome_autor=Nome_autor_l ORDER BY Cod_autor ASC;";
        $result = $this->pdo->query($sql);

        $stocks = [];
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_autor' => $row['Cod_autor'],
                'Nome_autor' => $row['Nome_autor'],
                'Titulo' => $row['Titulo'],
                ];
        }
        } else {
            // echo "0 results";
        }
        return $stocks;
    }

    public function ddelete($Cod_livro, $Cod_autor){
        $sql = "DELETE FROM LIVRO_AUTOR WHERE Cod_livro=$Cod_livro AND Cod_autor=$Cod_autor";
        $stmt = $this->pdo->query($sql);
    }

    public function insert($Nome_autor){
        $sql = "INSERT INTO LIVRO_AUTOR (Nome_autor) VALUES ('$Nome_autor')";
        $stmt = $this->pdo->query($sql);
        
    }

    public function update($Cod_autor, $Nome_autor){
       $sql = "SELECT DISTINCT Nome_autor FROM LIVRO_AUTOR WHERE Cod_autor=$Cod_autor;";
        $stmt = $this->pdo->query($sql);

        $stocks = [];
        if ($stmt->num_rows > 0) {
        // output data of each row
        while($row = $stmt->fetch_assoc()) {
            $stocks[] = [
                'Nome_autor' => $row['Nome_autor'],
            ];
            
        }
        } else {
            // echo "0 results";
        }
        $auxiliar = implode(',', $stocks[0]);

        $sql = "UPDATE LIVRO SET Nome_autor_l='$Nome_autor' WHERE Nome_autor_l='$auxiliar';";
        $stmt = $this->pdo->query($sql);
        
        $sql = "UPDATE LIVRO_AUTOR SET Nome_autor = '$Nome_autor' WHERE Cod_autor=$Cod_autor;";
        $stmt = $this->pdo->query($sql);
    }
}
