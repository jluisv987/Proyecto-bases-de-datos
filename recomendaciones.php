<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    $usuario = $_SESSION['usuario'];
    $query="SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' ";
    $result=$mysqli->query($query) or die($mysqli->error.__LINE__);
    $row= mysqli_fetch_array($result);
    $id_usuario=$row['id_usuario'];
    $pais=$row['nacionalidad'];
    $genero=$row['genero'];
    $edad=$row['edad'];
    $ocupacion=$row['ocupacion'];

    //queries :c
    $query_pais="SELECT DISTINCT libros.id_libro AS id_libro,
    libros.portada AS portada,
    libros.titulo AS titulo,
    libros.isbn13 AS isbn13,
    autores.nombre_autor AS nombre_autor,
    autores.apellido_autor AS apellido_autor
    FROM usuarios,libros,libros_usuarios,libros_autores,autores
    WHERE usuarios.nacionalidad = '$pais'
    AND id_libro = libros_autores.libros_id_libro
    AND autores.id_autor=libros_autores.autores_id_autor
    AND libros_usuarios.libros_id_libro NOT IN(SELECT libros.id_libro FROM libros,usuarios,libros_usuarios WHERE usuarios.nombre_usuario='$usuario' AND libros_usuarios.usuarios_id_usuario='$id_usuario' AND libros_usuarios.libros_id_libro=libros.id_libro)
    AND id_libro = libros_usuarios.libros_id_libro
    ORDER BY libros.visitas DESC
    LIMIT 3";
    $result_pais=$mysqli->query($query_pais) or die($mysqli->error.__LINE__);

    $query_genero="SELECT DISTINCT libros.id_libro AS id_libro,
    libros.portada AS portada,
    libros.titulo AS titulo,
    libros.isbn13 AS isbn13,
    autores.nombre_autor AS nombre_autor,
    autores.apellido_autor AS apellido_autor
    FROM usuarios,libros,libros_usuarios,libros_autores,autores
    WHERE usuarios.genero = '$genero'
    AND id_libro = libros_autores.libros_id_libro
    AND autores.id_autor=libros_autores.autores_id_autor
    AND libros_usuarios.libros_id_libro NOT IN(SELECT libros.id_libro FROM libros,usuarios,libros_usuarios WHERE usuarios.nombre_usuario='$usuario' AND libros_usuarios.usuarios_id_usuario='$id_usuario' AND libros_usuarios.libros_id_libro=libros.id_libro)
    AND id_libro = libros_usuarios.libros_id_libro
    ORDER BY libros.visitas DESC
    LIMIT 3";
    $result_genero=$mysqli->query($query_genero) or die($mysqli->error.__LINE__);

    $query_ocupacion="SELECT DISTINCT libros.id_libro AS id_libro,
    libros.portada AS portada,
    libros.titulo AS titulo,
    libros.isbn13 AS isbn13,
    autores.nombre_autor AS nombre_autor,
    autores.apellido_autor AS apellido_autor
    FROM usuarios,libros,libros_usuarios,libros_autores,autores
    WHERE usuarios.ocupacion = '$ocupacion'
    AND id_libro = libros_autores.libros_id_libro
    AND autores.id_autor=libros_autores.autores_id_autor
    AND libros_usuarios.libros_id_libro NOT IN(SELECT libros.id_libro FROM libros,usuarios,libros_usuarios WHERE usuarios.nombre_usuario='$usuario' AND libros_usuarios.usuarios_id_usuario='$id_usuario' AND libros_usuarios.libros_id_libro=libros.id_libro)
    AND id_libro = libros_usuarios.libros_id_libro
    ORDER BY libros.visitas DESC
    LIMIT 3";
    $result_ocupacion=$mysqli->query($query_ocupacion) or die($mysqli->error.__LINE__);

    $query_edad="SELECT DISTINCT libros.id_libro AS id_libro,
    libros.portada AS portada,
    libros.titulo AS titulo,
    libros.isbn13 AS isbn13,
    autores.nombre_autor AS nombre_autor,
    autores.apellido_autor AS apellido_autor
    FROM usuarios,libros,libros_usuarios,libros_autores,autores
    WHERE usuarios.edad BETWEEN usuarios.edad-3 AND usuarios.edad+3
    AND id_libro = libros_autores.libros_id_libro
    AND autores.id_autor=libros_autores.autores_id_autor
    AND libros_usuarios.libros_id_libro NOT IN(SELECT libros.id_libro FROM libros,usuarios,libros_usuarios WHERE usuarios.nombre_usuario='$usuario' AND libros_usuarios.usuarios_id_usuario='$id_usuario' AND libros_usuarios.libros_id_libro=libros.id_libro)
    AND id_libro = libros_usuarios.libros_id_libro
    ORDER BY libros.visitas DESC
    LIMIT 3";
    $result_edad=$mysqli->query($query_edad) or die($mysqli->error.__LINE__);
?>
<div class="container p-4">
    <div class="col-md-8" >
        <h2>Recomendaciones por tu país</h2>
            <table class="table table-striped">
                <thead style="background: #5CA4A9">
                    <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">ISBN13</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Portada</th>
                    </tr>
                </thead >
                     <tbody>
                       <!--aqui van todos los libros owo-->
                       <?php
                           if(mysqli_num_rows($result_pais)==0)
                           {
                               echo "<h4>Por el momento no hay recomendaciones que mostrar</h4>";
                           }
                           $aux = 'a';
                           while($row = mysqli_fetch_array($result_pais))
                           {
                               if($aux!=$row['titulo'])
                               {
                                   echo "<tr>";
                                   echo "<td><a href='libro.php?id=".$row['id_libro']."'>" . $row['titulo'] ."</a></td>";
                                   echo "<td>" . $row['isbn13'] . "</td>";
                                   echo "<td>".$row['nombre_autor']." ".$row['apellido_autor']."</td>";
                                   echo "<td>".'<img src="data:image;base64,'.base64_encode($row['portada']).'"alt="Image" style="width:100px;height:150px;"'."</td>";
                                   echo "</tr>";
                               }
                               $aux=$row['titulo'];

                           }
                       ?>
                     </tbody>
                   </table>
           </div>
</div>

<div class="container p-4">
    <div class="col-md-8" >
        <h2>Recomendaciones por sexo</h2>
            <table class="table table-striped">
                <thead style="background: #5CA4A9">
                    <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">ISBN13</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Portada</th>
                    </tr>
                </thead >
                     <tbody>
                       <!--aqui van todos los libros owo-->
                       <?php
                           $aux = 'a';
                           if(mysqli_num_rows($result_genero)==0)
                           {
                               echo "<h4>Por el momento no hay recomendaciones que mostrar</h4>";
                           }
                           while($row = mysqli_fetch_array($result_genero))
                           {
                               if($aux!=$row['titulo'])
                               {
                                   echo "<tr>";
                                   echo "<td><a href='libro.php?id=".$row['id_libro']."'>" . $row['titulo'] ."</a></td>";
                                   echo "<td>" . $row['isbn13'] . "</td>";
                                   echo "<td>".$row['nombre_autor']." ".$row['apellido_autor']."</td>";
                                   echo "<td>".'<img src="data:image;base64,'.base64_encode($row['portada']).'"alt="Image" style="width:100px;height:150px;"'."</td>";
                                   echo "</tr>";
                               }
                               $aux=$row['titulo'];

                           }
                       ?>
                     </tbody>
                   </table>
           </div>
</div>
<div class="container p-4">
    <div class="col-md-8" >
        <h2>Recomendaciones por ocupacion</h2>
            <table class="table table-striped">
                <thead style="background: #5CA4A9">
                    <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">ISBN13</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Portada</th>
                    </tr>
                </thead >
                     <tbody>
                       <!--aqui van todos los libros owo-->
                       <?php
                            if(mysqli_num_rows($result_ocupacion)==0)
                            {
                                echo "<h4>Por el momento no hay recomendaciones que mostrar</h4>";
                            }
                           $aux = 'a';
                           while($row = mysqli_fetch_array($result_ocupacion))
                           {
                               if($aux!=$row['titulo'])
                               {
                                   echo "<tr>";
                                   echo "<td><a href='libro.php?id=".$row['id_libro']."'>" . $row['titulo'] ."</a></td>";
                                   echo "<td>" . $row['isbn13'] . "</td>";
                                   echo "<td>".$row['nombre_autor']." ".$row['apellido_autor']."</td>";
                                   echo "<td>".'<img src="data:image;base64,'.base64_encode($row['portada']).'"alt="Image" style="width:100px;height:150px;"'."</td>";
                                   echo "</tr>";
                               }
                               $aux=$row['titulo'];

                           }
                       ?>
                     </tbody>
                   </table>
           </div>
</div>
<div class="container p-4">
    <div class="col-md-8" >
        <h2>Recomendaciones por edad</h2>
            <table class="table table-striped">
                <thead style="background: #5CA4A9">
                    <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">ISBN13</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Portada</th>
                    </tr>
                </thead >
                     <tbody>
                       <!--aqui van todos los libros owo-->
                       <?php
                           $aux = 'a';
                           if(mysqli_num_rows($result_edad)==0)
                           {
                               echo "<h4>Por el momento no hay recomendaciones que mostrar</h4>";
                           }
                           while($row = mysqli_fetch_array($result_edad))
                           {
                               if($aux!=$row['titulo'])
                               {
                                   echo "<tr>";
                                   echo "<td><a href='libro.php?id=".$row['id_libro']."'>" . $row['titulo'] ."</a></td>";
                                   echo "<td>" . $row['isbn13'] . "</td>";
                                   echo "<td>".$row['nombre_autor']." ".$row['apellido_autor']."</td>";
                                   echo "<td>".'<img src="data:image;base64,'.base64_encode($row['portada']).'"alt="Image" style="width:100px;height:150px;"'."</td>";
                                   echo "</tr>";
                               }
                               $aux=$row['titulo'];

                           }
                       ?>
                     </tbody>
                   </table>
           </div>
</div>
</div>

<?php include('includes/footer.php');?>
