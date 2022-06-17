<?php
echo(' data ');
require 'conexao.php';
echo(' database ');
use ConexaoPHPPostgres\Connection as Connection;
echo(' database.ini ');
$pdo = Connection::get()->connect();