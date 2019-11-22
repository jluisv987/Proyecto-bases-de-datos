
 <?php include('includes/database.php');?>
 <?php include('includes/header.php');?>
 <?php
     $id = $_GET['id'];
     $query_libros="SELECT titulo ,portada ,isbn13 ,descripcion FROM libros WHERE id_libro='$id'";
     $result_libros=$mysqli->query($query_libros) or die($mysqli->error.__LINE__);
     $row = mysqli_fetch_array($result_libros);
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
<div class="container p-4">
    <div class="card card-body">
        <?php echo "<h2>".$row['titulo']."</h2>"; ?>
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
