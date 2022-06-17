<?php
namespace ConexaoPHPPostgres;

class LivroModel{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

  public function all(){
        $sql = "SELECT Cod_livro, Titulo, Nome_editora_l, Nome_autor_l FROM LIVRO ORDER BY Titulo ASC";
        $result = $this->pdo->query($sql);

        $stocks = [];
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_editora_l' => $row['Nome_editora_l'],
                'Nome_autor_l' => $row['Nome_autor_l'],
            ];
        }
        } else {
            // echo "0 results";
        }
        return $stocks;
    }
    
    public function getLivroAutor(){
        $sql = "SELECT DISTINCT Cod_livro, Titulo, Nome_autor_l, Nome_editora_l FROM LIVRO INNER JOIN LIVRO_AUTOR ON Nome_autor=Nome_autor_l ORDER BY Titulo;";
        $result = $this->pdo->query($sql);
        
        $stocks = [];
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_autor_l' => $row['Nome_autor_l'],
                'Nome_editora_l' => $row['Nome_editora_l'],
            ];
        }
        }else{
            // echo '0 results';
        }
        return $stocks;
    }
    
     public function getLivroCopias(){
        $sql = "SELECT DISTINCT LIVRO.Cod_livro, Titulo, Nome_autor, UNIDADE_BIBLIOTECA.Cod_unidade, UNIDADE_BIBLIOTECA.Nome_unidade, Qt_copia FROM LIVRO_COPIAS INNER JOIN LIVRO ON LIVRO_COPIAS.Cod_livro=LIVRO.Cod_livro INNER JOIN LIVRO_AUTOR ON LIVRO.Nome_autor_l=LIVRO_AUTOR.Nome_autor INNER JOIN UNIDADE_BIBLIOTECA ON LIVRO_COPIAS.Cod_unidade=UNIDADE_BIBLIOTECA.Cod_unidade ORDER BY Nome_autor;";
        $result = $this->pdo->query($sql);
        
        $stocks = [];
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_autor' => $row['Nome_autor'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Qt_copia' => $row['Qt_copia'],
            ];
        }
        }else{
            // echo '0 results';
        }
        return $stocks;
    }

    public function ddelete($Cod_Livro){
        $sql = "DELETE FROM LIVRO WHERE Cod_Livro=$Cod_Livro";
        $stmt = $this->pdo->query($sql);
    }

      public function insert($Titulo, $Nome_autor_l, $Nome_editora_l){
        $sql = "INSERT INTO LIVRO (Titulo,  Nome_autor_l, Nome_editora_l)
        VALUES ('$Titulo', '$Nome_autor_l', '$Nome_editora_l')";
        $stmt = $this->pdo->query($sql);
    }
    
    public function insertInLivroCopias($Cod_livro, $Cod_unidade, $Quantidade){
        $sql = "INSERT INTO LIVRO_COPIAS (Cod_livro,Cod_unidade,Qt_copia) VALUES ($Cod_livro, $Cod_unidade, $Quantidade)";
        $stmt = $this->pdo->query($sql);
    }

     public function update($Cod_livro, $Titulo){
         echo('  (.update:cod_livro: )=>');
         echo($Cod_livro);
         echo('  (.update:titulo: )');
         echo($Titulo);
        $sql = "UPDATE LIVRO SET Titulo='$Titulo' WHERE Cod_livro=$Cod_livro";
        // echo(' 2foi? ');
        $stmt = $this->pdo->query($sql);
        // echo(' 3foi? msm ');
    }
}