<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\AutorModel as AutorModel;

try {
	$AutorModel = new AutorModel($pdo);
	$LivroModel = new LivroModel($pdo);	
}catch (\PDOException $e) {
    echo $e->getMessage();
}

$Cod_livro = null;
$Cod_autor = null;
$Nome_autor = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/CadastroAutor.php?MSGERROR=Campo Nome em Branco");
		die();
	}
		$Nome = $_POST['Nome'];

		try {
			$AutorModel->insert($Nome);
			header("Location: ../../pages/CadastroAutor.php?MSG=Cadastrado com Sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/CadastroAutor.php?MSG=Erro ao Cadastrar");	
		}
        
}elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome_autor'])){
		header("Location: ../../pages/CadastroAutor.php?MSGERROR=Nome em Branco");
		die();
	} 
	elseif(empty($_POST['Cod_autor'])){
	    header("Location: ../../pages/CadastroAutor.php?MSGERROR=Codigo Incorreto");
		die();
	}
	else {
        $Cod_autor = $_POST['Cod_autor'];
		$Nome_autor = $_POST['Nome_autor'];
		try {
			$AutorModel->update($Cod_autor, $Nome_autor);
			header("Location: ../../pages/CadastroAutor.php?MSG=Alterado com Sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/CadastroAutor.php?MSG=Não Foi Possível Alterar");	
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod_livro = $_POST['Cod_livro'];
    $Cod_autor = $_POST['Cod_autor'];
	try {
	$AutorModel->ddelete($Cod_livro);
	header("Location: ../../pages/autoresCadastrados.php?MSG=Deletado com Sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/autoresCadastrados.php?MSG=Não Foi POssível Deletar");	
	}
}
?>