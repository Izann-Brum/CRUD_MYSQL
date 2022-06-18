<?php
echo(' data /n/ ');
require 'conexao.php';
echo(' database /n/');
use ConexaoPHPPostgres\Connection as Connection;
echo(' database.ini  /n/');
$pdo = Connection::get()->connect();