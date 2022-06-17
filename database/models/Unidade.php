<?php

namespace ConexaoPHPPostgres;

class novaUnidadesModel{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    
    public function all(){
        $sql = "SELECT Cod_unidade, Nome_unidade, Endereco FROM UNIDADE_BIBLIOTECA  ORDER BY Cod_unidade ASC";
        $result = $this->pdo->query($sql);
        
        $stocks = [];
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Endereco' => $row['Endereco'],
            ];
        }
        } else {
            echo "0 results";
        }
        return $stocks;
    }

    public function insert($Nome_unidade, $Endereco){
        $sql = "INSERT INTO UNIDADE_BIBLIOTECA (Endereco, Nome_unidade) 
        VALUES ('$Endereco', '$Nome_unidade')";
        $stmt = $this->pdo->query($sql);
    }


    
    public function update($Cod_unidade, $Nome_unidade, $Endereco){
        $sql = "UPDATE UNIDADE_BIBLIOTECA SET Nome_unidade='$Nome_unidade', Endereco='$Endereco' WHERE Cod_unidade=$Cod_unidade";
        $stmt = $this->pdo->query($sql);

        if ($stmt == TRUE) {
            // echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }

    public function ddelete($Cod_unidade){
        $sql = "DELETE FROM \"Unidade_Biblioteca\" WHERE \"Cod_unidade\" = $Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $sql = "DELETE from \"Livro_copias\" WHERE \"Cod_unidade_copias\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
