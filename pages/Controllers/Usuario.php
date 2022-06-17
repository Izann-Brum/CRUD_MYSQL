<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\CadastroUsuarioModel as UsuarioModel;

try {
	$UsuarioModel = new UsuarioModel($pdo);
}catch (\PDOException $e) {
    echo $e->getMessage();
}

$Nome = null;
$Endereco = null;
$Telefone = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/CadastroUsuario.php?MSGERROR=Nome em Branco");
		die();
	}elseif(empty($_POST['Telefone'])){
		header("Location: ../../pages/CadastroUsuario.php?MSGERROR=Telefone em Branco");
		die();
	}else {
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];
		try {
			$UsuarioModel->insert($Nome, $Endereco, $Telefone);
			header("Location: ../../pages/CadastroUsuario.php?MSG=Cadastrado com Sucesso");
		} catch (\PDOException $e) {
	        echo $e->getMessage();
			header("Location: ../../pages/CadastroUsuario.php?MSGERROR=Impossível Inserir Usuário");
		}
        
		
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/usuariosCadastrados.php?MSGERROR=Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])){
		header("Location: ../../pages/usuariosCadastrados.php?MSGERROR=Data de Nascimento em Branco");
		die();
	} else {
		$Numero_cartao = $_POST['Num_cartao'];
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			$UsuarioModel->update($Numero_cartao, $Nome, $Endereco, $Telefone);
			header("Location: ../../pages/usuariosCadastrados.php?MSG=Alterado com Sucesso");
		} catch (\PDOException $e) {
			header("Location: ../../pages/usuariosCadastrados.php?MSG=Erro ao Alterar Usuário");
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Numero_cartao = $_POST['Num_cartao'];

	try {
		$UsuarioModel->ddelete($Numero_cartao);
		header("Location: ../../pages/usuariosCadastrados.php?MSG=Deletado com Sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/usuariosCadastrados.php?MSG=Erro ao Deletar Usuário");	
	}
}
?>