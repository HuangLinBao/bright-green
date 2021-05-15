<?php
$dsn = "mysql:host=localhost; dbname=bright_green;";

try{
    $pdo = new PDO($dsn, 'root','123456');
}
catch(PDOException $e){
    echo $e->getMessage();
}

?>