<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\EmprestimoModel as EmprestimoModel;

try {
	$EmprestimoModel = new EmprestimoModel($pdo);
	$CopiasModel = new LivroModel($pdo);

	$Emprestimo = $EmprestimoModel->all();

} catch (\PDOException $e) {
	echo $e->getMessage();
}

$Data_emprestimo = null;
$Data_devolucao = null;
$Cod_unidade = null;
$Cod_livro = null;
$Numero_cartao = null;
$Copias = null;
$Cod_unidade_int = null;
$Cod_livro_int = null;

if ($_POST['submit']=='INSERIR'){
	if (empty($_POST['Cod_livro'])){
		header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Livro em branco!");
		die();
	}elseif (empty($_POST['Cod_unidade'])) {
		header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Unidade em branco!");
		die();
	} elseif (empty($_POST['Num_cartao'])) {
		header("Location: ../../pages/novosEmprestimo.php?MSGERROR=Aluno em branco!");
		die();
	} elseif (empty($_POST['Data_emprestimo'])) {
		header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Data em branco!");
		die();
	} 
	else {
		$Numero_cartao = $_POST['Num_cartao'];
		$Cod_livro = $_POST['Cod_livro'];
		$Cod_unidade = $_POST['Cod_unidade'];
		$Data_emprestimo = $_POST['Data_emprestimo'];
        $ano = substr($Data_emprestimo,0,4);
        $ano = intval($ano)+1;
        $Data_devolucao = $ano.substr($Data_emprestimo,4);
		
		$Cod_livroi = intval($Cod_livro);
		$Cod_unidadei = intval($Cod_unidade);
		
		try {
			$Copias = $CopiasModel->QuantidadeCopias($Cod_unidadei, $Cod_livroi);
			$arrayForString = implode(',', $Copias[0]);
			$stringForInt = intval($arrayForString);
			echo('Quantidade de cópias: ');
            echo($stringForInt);
			if ($stringForInt > 0) {	    
			try {
        	$EmprestimoModel->insert($Cod_livro, $Cod_unidade, $Numero_cartao, $Data_emprestimo, $Data_devolucao);
			$EmprestimoModel->diminuirCopias($Cod_livro, $Cod_unidade);
			header("Location: ../../pages/novoEmprestimo.php?MSG=Livro Emprestado Com Sucesso!");
		} catch (\PDOException $e) {
			echo $e->getMessage();
			header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Usuário Já Possuí Este Título");
		}
			}else{
				header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Livro Indisponível Nesta Unidade");
				die();
			}
		}catch (\PDOException $e) {
			echo $e->getMessage();
			header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Cópia Indisponível Nesta Unidade");
		}	
	}
} elseif($_POST['submit']=='Devolver'){
	$Numero_cartao = $_POST['Num_cartao'];
	$Cod_livro = $_POST['Cod_livro'];
	$Cod_unidade = $_POST['Cod_unidade'];
	
	try {
		$EmprestimoModel->ddelete($Numero_cartao, $Cod_livro, $Cod_unidade);
		$EmprestimoModel->aumentarCopias($Cod_livro, $Cod_unidade);
		header("Location: ../../pages/emprestimosPendentes.php?MSG=Devolvido com sucesso!");
	} catch (\PDOException $e) {
		header("Location: ../../pages/emprestimosPendentes.php?MSGERROR=Erro ao Deletar Empréstimo");
	}
}
?>