<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    if($_POST['usuario']=="" or $_POST['contrasena']=="")
    echo "<div class=\"alert alert-danger\" role=\"alert\">
    Error, ingrese un usuario y contraseña
    </div>";
    else {
        $usuario=$_POST['usuario'];
        $contrasena=$_POST['contrasena'];
        $query="SELECT id_usuario FROM usuarios WHERE nombre_usuario = '$usuario' AND contraseña='$contrasena'";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
        $row = mysqli_fetch_array($result);
        if($row['id_usuario']>0)
        {
            //session_start();

            if(isset($usuario)){
                $_SESSION["usuario"] = $usuario;
                header('Location: index.php');
                exit();
            }

        }
        else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            Error, usuario o contraseña incorrecta
            </div>";
        }
    }
 ?>
 <div class="container p-4">
     <div class="row">
         <div class="col-md-10">

             <div class="card card-body">
                 <form  class="form_search" method="post" action="loguear.php" enctype="multipart/form-data">
                     <p>Usuario</p>
                     <input type="text" name="usuario" class="form-control">
                     <p>Contraseña</p>
                     <input type="text" name="contrasena" class="form-control">
                     <input type="submit" name="boton" value="Entrar" class="form-control">
                 </form>
             </div>
         </div>
     </div>
 </div>
<?php include('includes/footer.php');?>
