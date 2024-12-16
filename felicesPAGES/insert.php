<?php
require("connection.php"); 

$sqlQuery = "SELECT * FROM article WHERE Name='Neuer-Artikel'";
$result = $conn->query($sqlQuery);

if ($result->num_rows == 0){
    $sqlQuery = "INSERT INTO article (Title, Text, Name) VALUES ('Neuer Artikel', 'Das ist ein neuer Artikel', 'Neuer-Artikel')";
    $result = $conn->query($sqlQuery);
    //echo $result.'<br>';
    //echo $sqlQuery;
}
header("Location: article.php?name=Neuer-Artikel&mode=edit");



?>