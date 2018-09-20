<?php
// incluir archivo de configuracion
require_once 'config.php';

// definir variables y establecer valores vacios
$param_activo ="S";
$dni = $apellido = $nombre = $clave = $email = $rol_id = "";
$dni_err = $apellido_err = $nombre_err = $clave_err = $email_err = $rol_id_err = "";
 
// Procesando los datos del formulario cuando se envía el formulario
if(isset($_POST["id_usu"]) && !empty($_POST["id_usu"])){
   
// Obtenga un valor de entrada oculto
    $id_usu = $_POST["id_usu"];
    //validaciones dni
 $input_dni = trim($_POST["dni"]);
    if(empty($input_dni)){
        $dni_err = 'Ingrese el dni.';     
    }else{
        $dni = $input_dni;
    }
    
    //  apellido
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = 'Ingrese el apellido.';     
    } else{
        $apellido = $input_apellido;
    }
        //  nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = 'Ingrese el nombre.';     
    } else{
        $nombre = $input_nombre;
    }
          //  clave
    $input_clave = trim($_POST["clave"]);
    if(empty($input_clave)){
        $clave_err = 'Ingrese la clave.';     
    } else{
        $clave = $input_clave;
    }
    
           //  clave
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Ingrese la email.';     
    } else{
        $email = $input_email;
    }
    //  rol
    $input_rol_id = trim($_POST["rol_id"]);
   
        $rol_id = $input_rol_id;
 
// Verifique los errores de entrada antes de insertarlos en la base de datos
    if(empty($dni_err) && empty($apellido_err) && empty($nombre_err) && empty($clave_err) && empty($email_err) && empty($rol_err) ){
        // preparar la consulta
        $sql = "UPDATE usuarios SET dni=?, apellido=?, nombre=?, clave=?, email=?, rol_id=? WHERE id_usu=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
// Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "sssssii", $param_dni, $param_apellido, $param_nombre, $param_clave, $param_email, $param_rol_id, $param_id_usu );
            
            //establecer parametros
            $param_dni = $dni;
            $param_apellido = $apellido;
            $param_nombre = $nombre;
            $param_clave = $clave;
            $param_email = $email;
            $param_rol_id = $rol_id;
            $param_id_usu = $id_usu;
            // tratar de ejecutar la consulta
            if(mysqli_stmt_execute($stmt)){
                // registro modificado exitosamente
                header("location: indexusu.php");
                exit();
            } else{
                echo "Algo anda mal, intente mas tarde.";
            }
        }
  
        mysqli_stmt_close($stmt);
    }
    
    // cerrar conexion
    mysqli_close($link);
} else{
 
// Comprobar la existencia del parámetro id antes de seguir procesando
    if(isset($_GET["id_usu"]) && !empty(trim($_GET["id_usu"]))){
        
// Obtener el parámetro de URL
        $id_usu =  trim($_GET["id_usu"]);
        
        // preparar la consulta
        $sql = "SELECT * FROM usuarios WHERE id_usu = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // vincular las variables
            mysqli_stmt_bind_param($stmt, "i", $param_id_usu);
            
            // establecer parametro
            $param_id_usu = $id_usu;
            
            // tratar de ejecutar la consulta
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                  //traer el array asociativo
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // recuperar valores de los campos
                    $dni = $row["dni"];
                    $apellido = $row["apellido"];
                    $nombre = $row["nombre"];
                    $clave = $row["clave"];
                    $email = $row["email"];
                    $rol_id = $row["rol_id"];
                    
                } else{
                    
// La URL no contiene una identificación válida. Redirigir a la página de error
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Algo anda mal, intente mas tarde.";
            }
        }
        
     
        mysqli_stmt_close($stmt);
        
     
        mysqli_close($link);
    }  else{
       
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
    <title>Modificar Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
    
        $(document).ready(function(){
        $("#formdatos").validate({
            rules: {
                nombre:"required",
                apellido:"required",
                                
                dni:{
                    number:true,
                    range:[2000000,99000000]
                }
                
            },
            
            
            messages:{
                nombre:"Campo obligatorio",
                apellido:"Campo obligatorio",
                dni:{
                    number:"El campo debe ser numerico",
                    range:"Rango entre 2000000 y 99000000"
                }
            
            }
            
        });
    });
        
        
        
        
    </script>
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
                        <h2>Modificar Registro</h2>
                    </div>
                    <p>Modifique los valores y guarde el registro.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formdatos">
                        <div class="form-group <?php echo (!empty($dni_err)) ? 'has-error' : ''; ?>">
                            <label>DNI</label>
                            <input type="text" name="dni" class="form-control" value="<?php echo $dni; ?>" required>
                            <span class="help-block"><?php echo $dni_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="<?php echo $apellido; ?>" required>
                            <span class="help-block"><?php echo $apellido_err;?></span>
                        </div>
                          <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>" required>
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                          <div class="form-group <?php echo (!empty($clave_err)) ? 'has-error' : ''; ?>">
                            <label>Clave</label>
                            <input type="text" name="clave" class="form-control" value="<?php echo $clave; ?>" required>
                            <span class="help-block"><?php echo $clave_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div>
                            <label>Rol</label><br>
                            <select type="input" name="rol_id" class=" btn btn-warning" onchange="elegir_opcion(this);" value="<?php echo $rol_id;?>"> 
                       
                      
                        <option value="0" <?php if($rol_id == 0){echo 'selected';}?>>Seleccione</option>
                        <option value="1" <?php if($rol_id == 1){echo 'selected';}?>>Admin</option>
                        <option value="2" <?php if($rol_id == 2){echo 'selected';}?>>Supervisor</option>
                        <option value="3" <?php if($rol_id == 3){echo 'selected';}?>>Vendedor</option>
                        <option value="4" <?php if($rol_id == 4){echo 'selected';}?>>DataEntry</option>
                        <option value="5" <?php if($rol_id == 5){echo 'selected';}?>>WebAdmin</option>
					</select><br><br>
                        </div>
                        
                        <input type="hidden" name="id_usu" value="<?php echo $id_usu; ?>"/>
                        
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="indexusu.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>