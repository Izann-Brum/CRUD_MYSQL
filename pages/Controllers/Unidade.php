<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\novaUnidadesModel as NovaUnidade;

try {
    // echo(" 0 ");
    $NovaUnidade = new NovaUnidade($pdo);

} catch (\PDOException $e) {
    echo $e->getMessage();
}

$Cod = null;
$NomeUnidade = null;
$Endereco = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome_unidade'])){
		header("Location: ../../pages/CadastroUnidade.php?MSGERROR=Nome Em Branco");
		die();
	}
	elseif (empty($_POST['Endereco'])) {
		header("Location: ../../pages/CadastroUnidade.php?MSGERROR=Endereco Em Branco");
		die();
	}
	else {
		$NomeUnidade = $_POST['Nome_unidade'];
        $Endereco = $_POST['Endereco'];
        $NovaUnidade->insert($NomeUnidade, $Endereco);
		header("Location: ../../pages/CadastroUnidade.php?MSG=Cadastrado com Sucesso");
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome_unidade'])){
		header("Location: ../../pages/unidadesCadastradas.php?MSGERROR=Campo Nome Em Branco");
		die();
	}elseif (empty($_POST['Endereco'])) {
		header("Location: ../../pages/unidadesCadastradas.php?MSGERROR=Campo Endereço Em Branco");
		die();	
	}
	else {
		$NomeUnidade = $_POST['Nome_unidade'];
        $Endereco = $_POST['Endereco'];
		$Cod = $_POST['Cod_unidade'];
        $NovaUnidade->update($Cod, $NomeUnidade, $Endereco);
		header("Location: ../../pages/unidadesCadastradas.php?MSG=Alterado com Sucesso");
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod = $_POST['Cod_unidade'];
	$NovaUnidade->ddelete($Cod);
	header("Location: ../../pages/unidadesCadastradas.php?MSG=Deletado com Sucesso");
}
?>