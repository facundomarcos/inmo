<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title>Usuarios</title>
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
                        <h2 class="pull-left">Listado de Usuarios</h2>
                        
                        <a href="create.php" class="btn btn-success pull-right">Nuevo Usuario</a>
                    </div>
                    <?php
                    // incluir archivo de configuracion
                    require_once 'config.php';
                    
                    // tratar de ejecutar la consulta
                    $sql = "SELECT *
                        FROM usuarios 
                        WHERE activo='S'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>"; 
                                     
                                        echo "<th>DNI</th>";
                                        echo "<th>Apellido</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Clave</th>";
                                        echo "<th>email</th>";
                                        echo "<th>Rol</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        
                                    
                                        echo "<td>" . $row['id_usu'] . "</td>";
                                       
                                        echo "<td>" . $row['dni'] . "</td>";
                                        echo "<td>" . $row['apellido'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['clave'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . DetalleRol($row['rol_id']) . "</td>";

                                      
                                        echo "<td>";
                                            echo "<a href='read.php?id_usu=". $row['id_usu'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id_usu=". $row['id_usu'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id_usu=". $row['id_usu'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
 
                    // cerrar conexion
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>