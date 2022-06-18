<?php
include '/database/models.php';
include_once '/database/database.ini.php';

use ConexaoPHPPostgres\EditoraModel as EditoraModel;

try {
	echo(' 1 . ');
    $EditoraModel = new EditoraModel($pdo);
	echo(' 2 . ');
} catch (\PDOException $e) {
    echo $e->getMessage();
}

$Nome = null;
$Endereco = null;
$Telefone = null;
$Cod_editora = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/CadastroEditora.php?MSGERROR=Campo Nome em Branco");
		die();
	}elseif(empty($_POST['Telefone'])){
		header("Location: ../../pages/CadastroEditora.php?MSGERROR=Campo Telefone em Branco");
		die();
	}else {
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			$EditoraModel->insert($Nome, $Endereco, $Telefone);
            
			header("Location: ../../pages/CadastroEditora.php?MSG=Cadastrado com Sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/CadastroEditora.php?MSG=Erro ao Cadastrar");	
		}
        
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/editorasCadastradas.php?MSGERROR=Campo Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])){
		header("Location: ../../pages/editorasCadastradas.php?MSGERROR=Campo Telefone em Branco");
		die();
	} else {
		$Cod_editora = $_POST['Cod_editora'];
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			$EditoraModel->update($Cod_editora, $Nome, $Endereco, $Telefone);
			header("Location: ../../pages/editorasCadastradas.php?MSG=Alterado com Sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/editorasCadastradas.php?MSG=Erro ao Alterar Dados da Editora");
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Nome = $_POST['Cod_editora'];
	
	try {
		$EditoraModel->ddelete($Nome);	
		header("Location: ../../pages/editorasCadastradas.php?MSG=Deletado com Sucesso");
	} catch (\PDOException $e) {
		header("Location: ../../pages/editorasCadastradas.php?MSG=Erro ao Deletar Editora");
	}
}
?>