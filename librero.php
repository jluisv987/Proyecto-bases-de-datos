<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    $usuario = $_SESSION['usuario'];
    $query_id="SELECT id_usuario FROM usuarios WHERE nombre_usuario = '$usuario' ";
    $result_id=$mysqli->query($query_id) or die($mysqli->error.__LINE__);
    $row_id= mysqli_fetch_array($result_id);
    $id_usuario=$row_id['id_usuario'];
    $query=" SELECT libros.id_libro
    AS id_libro, libros.titulo
    AS titulo, libros.portada AS portada, libros.isbn13
    AS isbn13, autores.nombre_autor AS nombre_autor, autores.apellido_autor
    AS apellido_autor
    FROM libros_usuarios, autores, libros ,usuarios, libros_autores
    WHERE usuarios_id_usuario = '$id_usuario'
    AND id_libro = libros_usuarios.libros_id_libro
    AND id_libro = libros_autores.libros_id_libro
    AND autores.id_autor=libros_autores.autores_id_autor
    ORDER by titulo";
    $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
    <div class="col-md-8" >
        <h2>Todos tus libros</h2>
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
                           while($row = mysqli_fetch_array($result))
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


<?php include('includes/footer.php');?>
