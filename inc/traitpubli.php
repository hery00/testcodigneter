<?php

    include("function.php");
    session_start();

    sleep(2);
    header( "Content-Type: application/json"); 

    $text = $_POST['content'];
    $id_M = $_SESSION['idUser'];

    publier($id_M,$text);
    
?>