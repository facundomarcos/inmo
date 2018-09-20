<?php

if(isset($_GET["id_prop"]) && !empty(trim($_GET["id_prop"]))){
   
    require_once 'config.php';

    $sql = "SELECT * FROM propiedades
            WHERE id_prop=?";
    
    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id_prop"]);
  
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   
                $tipo = $row['tipo'];
                $codigo = $row['codigo'];
                $operacion = $row['operacion'];
                $ambientes = $row['ambientes'];
                $estado = $row['estado'];
                $direccion = $row['direccion'];
                $adicional = $row['adicional'];
                $imagen = $row['imagen'];
                $activo = $row['activo'];
               
            } else{
 
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     

    mysqli_stmt_close($stmt);
    

    mysqli_close($link);
} else{

    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Registro</title>
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
                        <h1><?php echo $row["codigo"]; ?></h1>
                    </div>
                     <div class="info-casa">
                            <img src="../fotos/<?php echo $imagen ?>"alt=""><br>
                           <br>
                        </div>
                    <div class="form-group">
                        <label>Tipo</label>
                        <p class="form-control-static"><?php echo DetalleTipo($row["tipo"]); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Operacion</label>
                        <p class="form-control-static"><?php echo DetalleOperacion($row["operacion"]); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ambientes</label>
                        <p class="form-control-static"><?php echo $row["ambientes"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <p class="form-control-static"><?php echo DetalleUso($row["estado"]); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Adicional</label>
                        <p class="form-control-static"><?php echo $row["adicional"]; ?></p>
                    </div>
                  
                    <p><a href="indexprop.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>