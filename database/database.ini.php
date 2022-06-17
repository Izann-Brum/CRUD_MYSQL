<?php

require 'conexao.php';

use ConexaoPHPPostgres\Connection as Connection;
echo(' database.ini ');
$pdo = Connection::get()->connect();