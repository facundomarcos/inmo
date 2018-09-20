<?php

if(isset($_POST["id_prop"]) && !empty($_POST["id_prop"])){
 
    require_once 'config.php';
    
 
    $sql = "UPDATE propiedades set activo='N' WHERE id_prop = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_id_prop);
        $param_id_prop = trim($_POST["id_prop"]);
 
        if(mysqli_stmt_execute($stmt)){

            header("location: indexprop.php");
            exit();
        } else{
            echo "Oops! Algo anda mal. Intenta mas tarde.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
} else{

    if(empty(trim($_GET["id_prop"]))){

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
                            <input type="hidden" name="id_prop" value="<?php echo trim($_GET["id_prop"]); ?>"/>
                            <p>Estas seguro de borrar el registro?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="indexprop.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>