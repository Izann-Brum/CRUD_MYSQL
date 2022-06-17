<?php
echo('0. ');
include '/database/models.php';
echo('0,5. ');
include_once '/database/database.ini.php';

use ConexaoPHPPostgres\AutorModel as AutorModel;
try {
    echo('1. ');
    $AutorModel = new AutorModel($pdo);
    echo('2. ');
     $Autores2 = $AutorModel->all();
    $Autores = $AutorModel->autorWithTitle();
    echo('3. ');
   

} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>

<?php
include('../templates/header.php');
?>

<div id="bb1" style = "min-height: 100vh;">
<?php
if (isset($_GET['MSGERROR'])){
	echo '<h2 style="color:red"><center>'.$_GET['MSGERROR'].'</h2></center>';
}
if (isset($_GET['MSG'])){
	echo '<h2 style="color:green"><center>'.$_GET['MSG'].'</h2></center>';
}
?>

<style> table {background: #FFFFFF; box-shadow: 0px 16px 32px rgba(5, 18, 34, 0.08); border-radius: 24px;  font-family: arial, sans-serif;   border-collapse: collapse;   width: 100%; padding: 32px;}  
td, th {   border: 1.5px solid #dddddd;   text-align: center;   padding: 8px; } 
tr {   background-color: #ffffff; } </style>
<table class="table">
    <tr>
        <th>Novo Autor</th>
    </tr>
    <tr>
        <th>Nome</th>
        <th>Cadastrar</th>
    </tr>
    
	<form action="../pages/Controllers/Autor.php" method="POST">
	<tr>
        <td><center><input type="text" name="Nome" value="" placeholder="Nome do Autor" class="input-group-text" required></center></td>
        <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
    </tr>
	</form>

    <tr>
        <th>Autores Cadastrados</th>
    </tr>
     <tr>
        <th>Nome</th>
        <th>Comandos</th>
    </tr>
     <?php foreach ($Autores2 as $Autor) : ?>
    <tr>
		<form action="../pages/Controllers/Autor.php" method="POST">
        
        <td><center><input type="text" name="Nome_autor" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Nome_autor'])?>" ></center></td>
        <input type="hidden" name="Cod_autor" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Cod_autor'])?>">

        <td><input class="btn btn-success" type="submit" name="submit" value="Alterar" style ="margin-right: 16px;"><input class="btn btn-danger" type="submit" name="submit" value="Deletar"></td>
		</form>
    </tr>
    <?php endforeach; ?>

     <tr>
        <th>Autores Cadastrados Com Livro</th>
    </tr>
     <tr>
        <th>Nome</th>
        <th>Livro</th>
        <th>Comandos</th>
    </tr>
     <?php foreach ($Autores as $Autor) : ?>
    <tr>
		<form action="../pages/Controllers/Autor.php" method="POST">
        
        <td><center><input type="text" name="Nome_autor" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Nome_autor'])?>" readonly></center></td>
        <input type="hidden" name="Cod_autor" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Cod_autor'])?>">

        <td><center><input type="text" name="Titulo" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Titulo'])?>" readonly></center></td>
        <input type="hidden" name="Titulo" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Titulo'])?>">
		
        <td><input class="btn btn-success" type="submit" name="submit" value="Alterar" style ="margin-right: 16px;"><input class="btn btn-danger" type="submit" name="submit" value="Deletar"></td>
		</form>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php
include('../templates/footer.php');
?>
