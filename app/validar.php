<?php

try{
    $base=new PDO("mysql:host=localhost; dbname=inmobiliaria", "root", "z5VqdJiRmcJea4");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="select * from usuarios where email= :email and clave= :clave";
    $resultado=$base->prepare($sql);
    $email=($_POST['email']);
    $clave=($_POST['clave']);
    $resultado->bindValue(":email", $email);
    $resultado->bindValue(":clave", $clave);
    $resultado->execute();
    $registro=$resultado->rowCount();
    if($registro!=0){
        session_start();
        $_SESSION["usuario"]=$_POST["email"];
        header("Location:indexusu.php");
    }else{
        header("location: login.html");
    }
    
    
}catch(Exception $e){
    die("Error: " . $e->getMessage());
    
    
    
}

?>
