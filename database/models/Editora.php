<?php

namespace ConexaoPHPPostgres;

class EditoraModel{
    private $pdo;

    public function __construct($pdo){
        echo(' *public function __construct($pdo)* ');
        $this->pdo = $pdo;
    }

 public function all(){
        $sql = "SELECT Cod_editora, Nome, Endereco, Telefone FROM EDITORA ORDER BY Cod_editora ASC";
        $result = $this->pdo->query($sql);

        $stocks = [];
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_editora' => $row['Cod_editora'],
                'Nome' => $row['Nome'],
                'Endereco' => $row['Endereco'],
                'Telefone' => $row['Telefone']
            ];
        }
        } else {
            // echo "0 results";
        }
        return $stocks;
    }

    public function ddelete($Cod_editora){
        $sql = "DELETE FROM EDITORA WHERE Cod_editora=$Cod_editora";
        $stmt = $this->pdo->query($sql);

        if ($stmt == TRUE) {
            // echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $pdo->error;
        }
    }

    public function insert($Nome, $Endereco, $Telefone){
        $sql = "INSERT INTO EDITORA (Nome, Endereco, Telefone) VALUES ('$Nome', '$Endereco', '$Telefone')";
        $stmt = $this->pdo->query($sql);
    }

    public function update($Cod_editora, $Nome, $Endereco, $Telefone){
        $sql = "UPDATE EDITORA SET Nome='$Nome', Endereco='$Endereco', Telefone='$Telefone' WHERE Cod_editora=$Cod_editora";
        // Prepare statement *pesquisar signifcado de statemente
        $stmt = $this->pdo->query($sql);

        if ($stmt == TRUE) {
            // echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
}
