<?php 
//Conexão CRUD com o banco MySQL 
$dbHost = "localhost";
$dbUsuario = "root";
$dbPassword = ""; 
$db = "db_pst-backups_rms";


$conexao = new mysqli($dbHost,$dbUsuario,$dbPassword,$db);

//if($conexao->connect_errno)
//{
//    echo "ERROR!!!!";
//}
//else
//{
//    echo "CONEÃO EFETUADA COM SUCESSO!";/
//}

?>