<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    $query="SELECT libros.id_libro AS 'id_libro',
    libros.titulo AS 'titulo',
    libros.ISBN13 AS 'ISBN13',
    autores.nombre_autor AS 'nombre_autor',
    autores.apellido_autor AS 'apellido_autor',
    libros.portada AS 'portada'
    FROM libros,autores,libros_autores
    WHERE id_libro = libros_autores.libros_id_libro
    AND autores.id_autor=libros_autores.autores_id_autor
    ORDER BY libros.visitas DESC
    LIMIT 10";
    //Consigue los titulos
    $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
 ?>



    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
            <!--busqueda-->
                <div class="card card-body">
                    <form action="busqueda.php" method="get" class="form_search">
                        <input type="text" name="busqueda" class="form-control" placeholder="Escribe aqui tu busqueda">
                        <select class="form-control" name="seleccion">
                            <option>Titulo</option>
                            <option>Autor</option>
                            <option>Genero</option>
                            <option>ISBN13</option>
                            <option>Tipo</option>
                        </select>
                        <input type="submit" name="boton" value="Buscar" class="form-control">

                    </form>

                </div>

            </div>
            <!--Mostrar libros-->
            <div class="col-md-8" >
                <h2>Los 10 libros mas populares</h2>
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
                                    echo "<td>" . $row['ISBN13'] . "</td>";
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
