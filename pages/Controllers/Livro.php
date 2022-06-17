<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\AutorModel as AutorModel;

try {
// 	echo("1 ");
	$AutorModel = new AutorModel($pdo);
	$LivroModel = new LivroModel($pdo);	
// 	echo(" 2 ");
} catch (\PDOException $e) {
	echo $e->getMessage();
}

$Cod_livro = null;
$Titulo = null;
$Nome_autor = null;
$Nome_editora = null;
$auxiliar = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Titulo'])){
		header("Location: ../../pages/CadastroLivro.php?MSGERROR=Campo Titulo em Branco");
		die();
	}elseif (empty($_POST['Nome_autor'])){
		header("Location: ../../pages/CadastroLivro.php?MSGERROR=Campo Autor em Branco");
		die();
	}elseif (empty($_POST['Nome_editora'])){
		header("Location: ../../pages/CadastroLivro.php?MSGERROR=Campo Editora em Branco");
		die();
	}else {
		$Titulo = $_POST['Titulo'];
		$Nome_autor_l = $_POST['Nome_autor'];
		$Nome_editora = $_POST['Nome_editora'];

		try {
			$LivroModel->insert($Titulo, $Nome_autor_l, $Nome_editora);
			header("Location: ../../pages/CadastroLivro.php?MSG=Cadastrado com Sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/CadastroLivro.php?MSG=Erro ao Cadastrar");	
		}
        
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Cod_livro'])){
		header("Location: ../../pages/livrosCadastrados.php?MSGERROR=Campo Livro em Branco");
		die();
	} elseif (empty($_POST['Titulo'])){
		header("Location: ../../pages/livrosCadastrados.php?MSGERROR=Campo Titulo em Branco");
	}else {
		$auxiliar = $_POST['Cod_livro'];
		// echo(' .alterar:type auxiliar: ');
		// echo(gettype($auxiliar));
		$Cod_livro = intval($auxiliar);
		// echo(' .alterar:type Cod_livro: ');
		// echo(gettype($Cod_livro));
		// echo(' => ');
		// echo($Cod_livro);
		$Titulo = $_POST['Titulo'];
      
		try {
		    // echo(' try update: Cod_livro => ');
		    // echo($Cod_livro);
			$LivroModel->update($Cod_livro, $Titulo);
// 			echo(' 3 ');
			header("Location: ../../pages/livrosCadastrados.php?MSG=Alterado com Sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/livrosCadastrados.php?MSG=Ero ao Alterar Livro");	
		}  
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod_livro = $_POST['Cod_livro'];

	try {
		$LivroModel->ddelete($Cod_livro);
		header("Location: ../../pages/livrosCadastrados.php?MSG=Deletado com Sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/livrosCadastrados.php?MSG=Erro ao Deletar Livro");	
	}
}
?>