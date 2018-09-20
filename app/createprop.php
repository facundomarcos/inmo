<?php

require_once 'config.php';

$activo ="S";
$codigo = $tipo = $operacion = $ambientes = $estado = $direccion = $adicional = $imagen = "";
$codigo_err = $tipo_err = $operacion_err = $ambientes_err = $estado_err = $direccion_err = $adicional_err = $imagen_err = "";
 


if($_SERVER["REQUEST_METHOD"] == "POST"){

$input_codigo = trim($_POST["codigo"]);
    if(empty($input_codigo)){
        $codigo_err = 'Ingrese el codigo.';     
    }else{
        $codigo = $input_codigo;
    }

    $input_tipo = trim($_POST["tipo"]);
    if(empty($input_tipo)){
        $tipo_err = 'Ingrese el tipo de vivienda.';     
    } else{
        $tipo = $input_tipo;
    }
        //
    $input_operacion = trim($_POST["operacion"]);
    if(empty($input_operacion)){
        $operacion_err = 'Ingrese el tipo de operacion.';     
    } else{
        $operacion = $input_operacion;
    }
          //
    $input_ambientes = trim($_POST["ambientes"]);
    if(empty($input_ambientes)){
        $ambientes_err = 'Ingrese la cantidad de ambientes.';     
    } else{
        $ambientes = $input_ambientes;
    }
    
           // 
    $input_estado = trim($_POST["estado"]);
    if(empty($input_estado)){
        $estado_err = 'Ingrese el estado estado.';     
    } else{
        $estado = $input_estado;
    }
    
      $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = 'Ingrese la direccion.';     
    } else{
        $direccion = $input_direccion;
    }
    
      $input_adicional = trim($_POST["adicional"]);
           $adicional = $input_adicional;
  
    
        $input_imagen = trim($_POST["imagen"]);
        $imagen = $input_imagen;
    
    
    
    
    
    
    
    
     if(empty($codigo_err) && empty($tipo_err) && empty($operacion_err) && empty($ambientes_err) && empty($estado_err) && empty($direccion_err) ){
    
    
        $sql = "INSERT INTO propiedades (tipo, codigo, operacion, ambientes, estado, direccion, adicional, imagen, activo, id_prop) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           

            mysqli_stmt_bind_param($stmt, "ississsssi", $param_tipo, $param_codigo, $param_operacion, $param_ambientes, $param_estado, $param_direccion, $param_adicional, $param_imagen, $param_activo, $param_id_prop );
            
               $param_tipo = $tipo;
            $param_codigo = $codigo;
            $param_operacion = $operacion;
            $param_ambientes = $ambientes;
            $param_estado = $estado;
            $param_direccion = $direccion;
            $param_adicional = $adicional;
            $param_imagen = $imagen;
            $param_activo = $activo;
            $param_id_prop = $id_prop;
           
            // tratar de ejecutar la consulta preparada
            if(mysqli_stmt_execute($stmt)){
                // registro creado exitosamente, envia a la pagina principal de usuarios
                header("location: indexprop.php");
                exit();
            } else{
                echo "Algo anda mal, intente mas tarde.";
            }
        }
         
   
        mysqli_stmt_close($stmt);
    }
    
   
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Propiedad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  
       <link rel="stylesheet" href="../css/usuarios.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin:  auto;
        }
    </style>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Nueva Propiedad</h2>
                    </div>
                 
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formdatos">
                        
                            
                             <div class="form-group <?php echo (!empty($codigo_err)) ? 'has-error' : ''; ?>">
                            <label>Codigo</label>
                            <input type="text" name="codigo" class="form-control" value="<?php echo $codigo; ?>" required>
                            <span class="help-block"><?php echo $codigo_err;?></span>
                        </div>
                        
                         <div>
                            <label>Tipo de Propiedad</label><br>
                        <select type="input" name="tipo" class=" btn btn-warning" onchange="elegir_opcion(this);" value="<?php echo $tipo;?>"> 
                       

                        <option value="0" <?php if($tipo == 0){echo 'selected';}?>>Seleccione</option>
                        <option value="1" <?php if($tipo == 1){echo 'selected';}?>>Departamento</option>
                        <option value="2" <?php if($tipo == 2){echo 'selected';}?>>Casa</option>
                        <option value="3" <?php if($tipo == 3){echo 'selected';}?>>PH</option>
                        <option value="4" <?php if($tipo == 4){echo 'selected';}?>>Lote</option>
                        <option value="5" <?php if($tipo == 5){echo 'selected';}?>>Galpon</option>
                        <option value="6" <?php if($tipo == 6){echo 'selected';}?>>Campo</option>
                        <option value="7" <?php if($tipo == 7){echo 'selected';}?>>Cochera</option>
					</select><br><br>
                        </div>
                        
                            <div>
                            <label>Tipo de Operacion</label><br>
                        <select type="input" name="operacion" class=" btn btn-warning" onchange="elegir_opcion(this);" value="<?php echo $operacion;?>">
                      
						
                        <option value="0" <?php if($operacion == '0'){echo 'selected';}?>>Seleccione</option>
                        <option value="A" <?php if($operacion == 'A'){echo 'selected';}?>>Alquiler</option>
                        <option value="V" <?php if($operacion == 'V'){echo 'selected';}?>>Venta</option>
                      
                      
					</select><br><br>
                        </div>
                        
                        
                        
                          <div class="form-group <?php echo (!empty($ambientes_err)) ? 'has-error' : ''; ?>">
                            <label>Ambientes</label>
                            <input type="number" name="ambientes" class="form-control" value="<?php echo $ambientes; ?>" required>
                            <span class="help-block"><?php echo $ambientes_err;?></span>
                        </div>
                        
                          <div>
                            <label>Estado</label><br>
                               <select type="input" name="estado" class=" btn btn-warning" onchange="elegir_opcion(this);" value="<?php echo $estado;?>">
                       
                        <option value="0" <?php if($estado == '0'){echo 'selected';}?>>Seleccione</option>
                        <option value="N" <?php if($estado == 'N'){echo 'selected';}?>>Nuevo</option>
                        <option value="U" <?php if($estado == 'U'){echo 'selected';}?>>Usado</option>
                      
                      
					</select><br><br>
                        </div>
                    
                        
                          <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>direccion</label>
                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>" required>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                          <div class="form-group <?php echo (!empty($adicional_err)) ? 'has-error' : ''; ?>">
                            <label>adicional</label>
                            <input type="text" name="adicional" class="form-control" value="<?php echo $adicional; ?>" >
                            <span class="help-block"><?php echo $adicional_err;?></span>
                        </div>
                          <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>imagen</label>
                            <input type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>
                        
                        
                        
                        
                       
                        
                        <input type="hidden" name="id_prop" value="<?php echo $id_prop; ?>"/>
                        
                            
                            
                            
                            
                            
                    
                        
                        
                        
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="indexprop.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>