<?php

namespace ConexaoPHPPostgres;

class EmprestimoModel{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function diminuirCopias($Cod_livro, $Cod_unidade){
        $sql = "UPDATE \"Livro_copias\" SET \"Qt_copia\" = \"Qt_copia\" - 1 WHERE \"Cod_livro_copias\"=$Cod_livro AND \"Cod_unidade_copias\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function aumentarCopias($Cod_livro, $Cod_unidade){
        $sql = "UPDATE \"Livro_copias\" SET \"Qt_copia\" = \"Qt_copia\" + 1 WHERE \"Cod_livro_copias\"=$Cod_livro AND \"Cod_unidade_copias\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function all(){
        $sql = "SELECT Cod_livro, Cod_unidade, Nr_cartao, DATE_FORMAT(Data_emprestimo, '%d/%m/%Y') AS Data_emprestimo, DATE_FORMAT(Data_devolucao, '%d/%m/%Y') AS Data_devolucao FROM LIVRO_EMPRESTIMO;";
        $result = $this->pdo->query($sql);
        
        $stocks = [];
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Nr_cartao' => $row['Nr_cartao'],
                'Data_emprestimo' => $row['Data_emprestimo'],
                'Data_devolucao' => $row['Data_devolucao']
            ];
        }
        } else {
            // echo "0 results";
        }
        return $stocks;
    }
    
    public function getUnidadeLivroAluno(){
        $sql = "SELECT LIVRO.Cod_livro, Titulo, UNIDADE_BIBLIOTECA.Cod_unidade, Nome_unidade, USUARIO.Num_cartao, Nome, DATE_FORMAT(Data_emprestimo, '%d/%m/%Y') AS Data_emprestimo, DATE_FORMAT( Data_devolucao, '%d/%m/%Y') AS Data_devolucao FROM LIVRO_EMPRESTIMO INNER JOIN LIVRO ON LIVRO_EMPRESTIMO.Cod_livro=LIVRO.Cod_livro INNER JOIN UNIDADE_BIBLIOTECA ON UNIDADE_BIBLIOTECA.Cod_unidade=LIVRO_EMPRESTIMO.Cod_unidade INNER JOIN USUARIO ON USUARIO.Num_cartao=LIVRO_EMPRESTIMO.Nr_cartao;";
        $result = $this->pdo->query($sql);
        
        $stocks = [];
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Num_cartao' => $row['Num_cartao'],
                'Nome' => $row['Nome'],
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Data_emprestimo' => $row['Data_emprestimo'],
                'Data_devolucao' => $row['Data_devolucao']
            ];
        }
        } else {
            // echo "0 results";
        }
        return $stocks;
    }

    public function ddelete($Numero_cartao, $Cod_livro, $Cod_unidade){
        $sql = "DELETE from \"Livro_emprestimo\" WHERE \"Cod_livro_emprestimo\"=$Cod_livro AND \"Cod_unidade_emprestimo\"=$Cod_unidade AND \"Nr_cartao_emprestimo\"=$Numero_cartao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }   

    public function insert($Cod_livro, $Cod_unidade, $Numero_cartao, $Data_emprestimo, $Data_devolucao){
        $sql = "INSERT INTO LIVRO_EMPRESTIMO (Cod_livro, Cod_unidade, Nr_cartao, Data_emprestimo, Data_devolucao) VALUES ($Cod_livro, $Cod_unidade, $Numero_cartao, '$Data_emprestimo', '$Data_devolucao')";
        $stmt = $this->pdo->query($sql);
    }

    public function update($Data_emprestimo, $Data_devolucao, $Cod_livro, $Cod_unidade){
        $ano = substr($Data_emprestimo,0,4);
        $ano = $ano+(1);
        $Data_devolucao = $ano.substr($Data_emprestimo,4);
        $sql = "UPDATE \"Livro_emprestimo\" SET \"Data_emprestimo\"=TO_DATE ('$Data_emprestimo','DD-MM-YYYY'), \"Data_devolucao\"=TO_DATE ('$Data_devolucao','DD-MM-YYYY') WHERE \"Cod_livro_emprestimo\"=$Cod_livro AND \"Cod_unidade_emprestimo\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}