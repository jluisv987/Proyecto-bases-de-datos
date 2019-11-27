<?php include('includes/database.php');?>
<?php include('includes/header.php');?>

<?php
   if(isset($_POST['boton']))
   {
       $usuario=$_POST['nombre_usuario'];
       $nombre=$_POST['nombre'];
       $apellido=$_POST['apellido'];
       $contrasena=$_POST['contrasena'];
       $correo=$_POST['correo'];
       $genero=$_POST['genero'];
       $edad=$_POST['edad'];
       $ocupacion=$_POST['ocupacion'];
       $pais=$_POST['pais'];
       if($usuario=="" OR $contrasena=="" OR $correo==""
       OR $genero=="" OR $edad=="" OR $ocupacion==""  OR $pais == ""
       OR $nombre == "" OR $apellido == "")
       {
           echo "<div class=\"alert alert-danger\" role=\"alert\">
           Error, ingresa todos los campos del registro
           </div>";
       }
       else
       {
           if(isset($_FILES['imagen']))
           {

               if(!(getimagesize($_FILES['imagen']['tmp_name'])==FALSE))
               {

                   $imagen = $_FILES['imagen']['tmp_name'];
                   $imagen = file_get_contents($imagen);
                   $imagen = addslashes($imagen);
                   //$imagen = base64_encode($imagen);

               }
               else {
                   echo "<div class=\"alert alert-danger\" role=\"alert\">
                   Error, ingresa todos los campos del registro
                   </div>";
               }

           }
             $query="SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$usuario'";
             $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
             if(mysqli_num_rows($result)>=1)
             {
                 echo "<div class=\"alert alert-danger\" role=\"alert\">
                 Error, el nombre de usuario ya esta en uso
                 </div>";
             }
             else {
                 $query="INSERT INTO usuarios(nombre_usuario, nombre, apellido,
                     contraseña, edad, ocupacion, correo, nacionalidad, genero,imagen_perfil)
                 VALUES ('$usuario', '$nombre', '$apellido','$contrasena', '$edad', '$ocupacion'
                 , '$correo', '$pais', '$genero','$imagen' )";
                 $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
             }
             echo "<div class=\"alert alert-success\" role=\"alert\">
             Ya estas registrado en la página, entra con tu usuario y contraseña
             </div>";
       }

   }
 ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-10">
        <!--busqueda-->
            <div class="card card-body">
                <form  class="form_search" method="post" enctype="multipart/form-data">
                    <p>Nombre de usuario</p>
                    <input type="text" name="nombre_usuario" class="form-control">
                    <p>Contraseña</p>
                    <input type="text" name="contrasena" class="form-control">
                    <p>Correo</p>
                    <input type="text" name="correo" class="form-control">
                    <p>Genero</p>
                    <input type="text" name="genero" class="form-control">
                    <p>Edad</p>
                    <input type="text" name="edad" class="form-control">
                    <p>Ocupación</p>
                    <input type="text" name="ocupacion" class="form-control">
                    <p>País</p>
                    <input type="text" name="pais" class="form-control">
                    <p>Imagen de perfil</p>
                    <input type="file" name="imagen">
                <h5>Nombre y apellido</h5>
                <div class="row">

                    <div class="col-md-6">

                        <p>Nombre</p>
                        <input type="text"
                        name="nombre" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <p>Apellido</p>
                        <input type="text" name="apellido"
                        class="form-control">
                    </div>
                </div>

                    <input type="submit" name="boton" value="Agregar" class="form-control">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
