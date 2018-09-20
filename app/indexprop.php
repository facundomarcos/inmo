<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Propiedades</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
      <link rel="stylesheet"  href="../css/fontello.css">
    <link rel="stylesheet" href="../css/estilos.css">
     <link rel="stylesheet" href="../css/usuarios.css">
   
    
    <style type="text/css">
        .wrapper{
            width: 950px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 20px;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
   
<body>
        <?php
        session_start();
        if(!isset($_SESSION["usuario"])){
            header("location:login.html");
        }
    
    
    ?>
        	<header>
		<div class="contenedor">
		<h1 class ="icon-handshake-o">Inmobiliaria</h1>

		<input type="checkbox" id="menu-bar">
		<label class="icon-menu-outline" for="menu-bar"></label>
     
		<nav class="menu">

		<a href="../index.html">Inicio</a>
		<a href="indexusu.php">Usuarios</a>
		<a href="indexprop.php">Propiedades</a>
		<a href="../web/contacto.html">Contacto</a>
		<a href="../web/nosotros.html">Nosotros</a>
            <a> <?php echo $_SESSION["usuario"] ?></a>
            <a href="cerrarsesion.php">Salir</a>
            </nav>
            </div>
	</header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Listado de Propiedades</h2>
                        <a href="createprop.php" class="btn btn-success pull-right">Nueva Propiedad</a>
                    </div>
                    <?php
               
                    require_once 'config.php';
                    
             
                    $sql = "SELECT *
                        FROM propiedades 
                        WHERE activo='S'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>"; 
                                     echo "<th>Codigo</th>";
                                        echo "<th>Tipo</th>";
                                        
                                        echo "<th>Operacion</th>";
                                        echo "<th>Ambientes</th>";
                                        echo "<th>Estado</th>";
                                        echo "<th>Direccion</th>";
                                        echo "<th>Adicional</th>";
                                        echo "<th>Imagen</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        
                                    
                                        echo "<td>" . $row['id_prop'] . "</td>";
                                       echo "<td>" . $row['codigo'] . "</td>";
                                        echo "<td>" .DetalleTipo($row['tipo']) . "</td>";
                                        
                                        echo "<td>" .DetalleOperacion($row['operacion']) . "</td>";
                                        echo "<td>" . $row['ambientes'] . "</td>";
                                        echo "<td>" .DetalleUso($row['estado']) . "</td>";
                                        echo "<td>" . $row['direccion'] . "</td>";
                                        echo "<td>" . $row['adicional'] . "</td>";
                                        echo "<td>" . $row['imagen'] . "</td>";
                            

                                      
                                        echo "<td>";
                                            echo "<a href='readprop.php?id_prop=". $row['id_prop'] ."' title='Ver Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='updateprop.php?id_prop=". $row['id_prop'] ."' title='Modificar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteprop.php?id_prop=". $row['id_prop'] ."' title='Eliminar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                   
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No hay registros.</em></p>";
                        }
                    } else{
                        echo "ERROR: no fue posible ejecutar la consulta $sql. " . mysqli_error($link);
                    }
 
            
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>