
 <?php include('includes/database.php');?>
 <?php include('includes/header.php');?>

 <?php
     $id = $_GET['id'];

     $query_libros="SELECT titulo ,portada ,isbn13 ,descripcion,visitas FROM libros WHERE id_libro='$id'";
     $result_libros=$mysqli->query($query_libros) or die($mysqli->error.__LINE__);
     $row = mysqli_fetch_array($result_libros);
     $visita=$row['visitas']+1;
     $visitas = "UPDATE libros SET visitas ='$visita' WHERE id_libro='$id'";
     $result_visitas=$mysqli->query($visitas) or die($mysqli->error.__LINE__);
     $query_autores="SELECT autores.nombre_autor AS 'nombre_autor',
        autores.apellido_autor AS 'apellido_autor'
        FROM autores, libros_autores, libros
        WHERE
        libros.id_libro = '$id'
        AND libros.id_libro = libros_autores.libros_id_libro
        AND autores.id_autor=libros_autores.autores_id_autor";
     $result_autores=$mysqli->query($query_autores) or die($mysqli->error.__LINE__);

     $query_tipos="SELECT tipos.tipo AS 'tipo'
        FROM tipos, tipos_libros, libros
        WHERE
        libros.id_libro ='$id'
        AND libros.id_libro = tipos_libros.libros_id_libro
        AND tipos.id_tipo = tipos_libros.tipos_id_tipo";
     $result_tipos=$mysqli->query($query_tipos) or die($mysqli->error.__LINE__);

     $query_generos="SELECT generos.genero AS 'genero'
        FROM generos_libros,generos, libros
        WHERE
        libros.id_libro ='$id'
        AND libros.id_libro = generos_libros.libros_id_libro
        AND generos.id_generos=generos_libros.generos_id_generos";
     $result_generos=$mysqli->query($query_generos) or die($mysqli->error.__LINE__);
  ?>
  <?php
     if(isset($_POST['boton']))
     {
         $usuario = $_SESSION['usuario'];
         $query_id="SELECT id_usuario FROM usuarios WHERE nombre_usuario = '$usuario' ";
         $result_id=$mysqli->query($query_id) or die($mysqli->error.__LINE__);
         $row_id= mysqli_fetch_array($result_id);
         $id_usuario=$row_id['id_usuario'];
         $query_usuario="SELECT libros_id_libro
         FROM libros_usuarios
         WHERE libros_id_libro = '$id' AND usuarios_id_usuario = '$id_usuario'";
         $result_usuario=$mysqli->query($query_usuario) or die($mysqli->error.__LINE__);
         if(mysqli_num_rows($result_usuario)>=1)
         {
             echo "<div class=\"alert alert-danger\" role=\"alert\">
             Error, este libro ya ha sido agregado a tu cuenta
             </div>";
         }
         else {


            $vincular="INSERT INTO libros_usuarios (libros_id_libro, usuarios_id_usuario) VALUES ('$id', '$id_usuario')";
            $result_vincular= $mysqli->query($vincular) or die($mysqli->error.__LINE__);
            echo "<div class=\"alert alert-success\" role=\"alert\">
            Libro agregado excitosamente a tu perfil
            </div>";
         }
     }
   ?>
<div class="container p-4">
    <div class="card card-body">
        <?php echo "<h2>".$row['titulo']."  </h2>";
        if(isset($_SESSION["usuario"]))
        {
        echo "<form method=\"post\" class=\"form_search\">
            <input type=\"submit\" name=\"boton\" value=\"Agregar libro\" class=\"form-control\" style=\"background-color: springgreen\"></form>";
        }
         ?>

        <div class="row">

            <div class="col-md-5">
               <?php

                echo '<img src="data:image;base64,'.base64_encode($row['portada']).'"alt="Image" style="width:300px;height:450px;"';
                ?>
            </div>


        </div>

        <div class="col-md-4">
             <?php
                echo "<p><b>ISBN13</b>: ".$row['isbn13']."</p>";
                echo "<p><b>Descripción</b>: ".$row['descripcion']."</p>";
                echo "<p> <b>Autor(es): </b>";
                while ($row= mysqli_fetch_array($result_autores)) {
                    echo $row['nombre_autor']." ".$row['apellido_autor']." ";
                }
                echo "</p>";
                echo "<p> <b>Tipos: </b>";
                while ($row= mysqli_fetch_array($result_tipos)) {
                    echo $row['tipo']." ";
                }
                echo "</p>";
                echo "<p> <b>Generos: </b>";
                while ($row= mysqli_fetch_array($result_generos)) {
                    echo $row['genero'].", ";
                }
                echo "</p>";
            ?>
        </div>

    </div>
    </div>
</div>
 <?php include('includes/footer.php');?>
