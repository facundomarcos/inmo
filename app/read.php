<?php

// Comprobar la existencia del parámetro id antes de seguir procesando
if(isset($_GET["id_usu"]) && !empty(trim($_GET["id_usu"]))){
    // incluir archivo de configuracion
    require_once 'config.php';
    
    //preparar la consulta sql
    $sql = "SELECT * FROM usuarios
            WHERE id_usu=?";
    
    if($stmt = mysqli_prepare($link, $sql)){
       
// Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // establecer parametros
        $param_id = trim($_GET["id_usu"]);
        
    // Intenta ejecutar la declaración preparada
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
              
//Obtener fila de resultados como una matriz asociativa. Dado que el conjunto de resultados contiene solo una fila, no necesitamos usar while loop 
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
             
// Recuperar valor de campo individual
              
                $dni = $row["dni"];
                $apellido = $row["apellido"];
                $nombre = $row["nombre"];
                $clave = $row["clave"];
                $email = $row["email"];
                $rol = $row["rol_id"];
                $foto = $row["foto"];
            } else{
                
// La URL no contiene un parámetro de id. Válido. Redirigir a la página de error
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    // cerrar declaracion
    mysqli_stmt_close($stmt);
    
    // cerrar conexion
    mysqli_close($link);
} else{
    
// URL no contiene el parámetro id. Redirigir a la página de error
    header("location: error.php");
    exit();
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
                        <h1><?php echo $row["nombre"] . " " . $row["apellido"]; ?></h1>
                    </div>
                     <div class="info-usuario">
                            <img src="../fotos/<?php echo $foto ?>"alt=""><br>
                           <br>
                        </div>
                    <div class="form-group">
                        <label>DNI</label>
                        <p class="form-control-static"><?php echo $row["dni"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <p class="form-control-static"><?php echo $row["apellido"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Clave</label>
                        <p class="form-control-static"><?php echo $row["clave"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Rol</label>
                        <p class="form-control-static"><?php echo DetalleRol($row["rol_id"]); ?></p>
                    </div>
                    <p><a href="indexusu.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>