<?php
// proceso de eliminacion
if(isset($_POST["id_usu"]) && !empty($_POST["id_usu"])){
    // incluir archivo de configuracion
    require_once 'config.php';
    
    // preparar consulta
    $sql = "UPDATE usuarios set activo='N' WHERE id_usu = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
       
// Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        
        //establecer parametros
        $param_id = trim($_POST["id_usu"]);
        
        
// Intenta ejecutar la declaración preparada
        if(mysqli_stmt_execute($stmt)){
            // registro borrado exitosamente, envia a pagina principal de usuarios
            header("location: indexusu.php");
            exit();
        } else{
            echo "Oops! Algo anda mal. Intenta mas tarde.";
        }
    }
     
    // cerrar consulta
    mysqli_stmt_close($stmt);
    
    // cerrar conexion
    mysqli_close($link);
} else{
    
// Comprobar la existencia del parámetro id
    if(empty(trim($_GET["id_usu"]))){
        
// URL no contiene el parámetro id. Redirigir a la página de error
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
       <link rel="stylesheet" href="../css/usuarios.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Eliminar Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id_usu" value="<?php echo trim($_GET["id_usu"]); ?>"/>
                            <p>Estas seguro de borrar el registro?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="indexusu.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>