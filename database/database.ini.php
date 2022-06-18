<?php
// echo(' -conexao- ');
require './conexao.php';

use ConexaoPHPPostgres\Connection as Connection;

$pdo = Connection::get()->connect();
echo('pdo-> ');
echo($pdo->$_SESSION);

