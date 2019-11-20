<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    $busqueda= $_REQUEST['busqueda'];
    $seleccion= $_REQUEST['seleccion'];
    if($seleccion=='Titulo')
    {
        $busqueda= strtolower($_REQUEST['busqueda']);
        $query="SELECT libros.titulo AS 'titulo',
        libros.ISBN13 AS 'ISBN13',
        autores.nombre_autor AS 'nombre_autor',
        autores.apellido_autor AS 'apellido_autor',
        libros.portada AS 'portada'
        FROM libros,autores,libros_autores
        WHERE titulo LIKE '%";
        $query.=$busqueda;
        $query.="%' AND libros.id_libro = libros_autores.libros_id_libro
        AND autores.id_autor=libros_autores.autores_id_autor
        ORDER BY titulo";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);


    }
    else if($seleccion=='Autor')
    {
        $busqueda= strtolower($_REQUEST['busqueda']);
        $query="SELECT libros.titulo AS 'titulo',
        libros.ISBN13 AS 'ISBN13',
        autores.nombre_autor AS 'nombre_autor',
        autores.apellido_autor AS 'apellido_autor',
        libros.portada AS 'portada'
        FROM libros,autores,libros_autores
        WHERE nombre_autor LIKE '%";
        $query.=$busqueda."%' OR ";
        $query.="apellido_autor LIKE '%".$busqueda."%'";
        $query.=" AND libros.id_libro = libros_autores.libros_id_libro
        AND autores.id_autor=libros_autores.autores_id_autor
        ORDER BY titulo";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
    }

    else if($seleccion=='Genero')
    {
        $busqueda= $_REQUEST['busqueda'];
        $query="SELECT libros.titulo AS 'titulo',
        libros.ISBN13 AS 'ISBN13',
        autores.nombre_autor AS 'nombre_autor',
        autores.apellido_autor AS 'apellido_autor',
        libros.portada AS 'portada',
        generos.genero AS 'genero'
        FROM libros,autores,libros_autores,generos,generos_libros
        WHERE genero ='";
        $query.=$busqueda;
        $query.="' AND libros.id_libro = libros_autores.libros_id_libro
        AND autores.id_autor=libros_autores.autores_id_autor
        AND libros.id_libro = generos_libros.libros_id_libro
        AND generos.id_generos=generos_libros.generos_id_generos
        ORDER BY titulo";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
    }

    else if($seleccion=='Tipo')
    {
        $busqueda= $_REQUEST['busqueda'];
        $query="SELECT libros.titulo AS 'titulo',
        libros.ISBN13 AS 'ISBN13',
        autores.nombre_autor AS 'nombre_autor',
        autores.apellido_autor AS 'apellido_autor',
        libros.portada AS 'portada',
        tipos.tipo AS 'tipo'
        FROM libros,autores,libros_autores,tipos,tipos_libros
        WHERE tipo = '";
        $query.=$busqueda;
        $query.="' AND libros.id_libro = libros_autores.libros_id_libro
                AND autores.id_autor=libros_autores.autores_id_autor
                AND libros.id_libro = tipos_libros.libros_id_libro
                AND tipos.id_tipo = tipos_libros.tipos_id_tipo
                ORDER BY titulo";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
    }
    else if($seleccion=='ISBN13')
    {
        $query="SELECT libros.titulo AS 'titulo',
        libros.ISBN13 AS 'ISBN13',
        autores.nombre_autor AS 'nombre_autor',
        autores.apellido_autor AS 'apellido_autor',
        libros.portada AS 'portada'
        FROM libros,autores,libros_autores
        WHERE ISBN13 = '";
        $query.=$busqueda."'";
        $query.="AND libros.id_libro = libros_autores.libros_id_libro
        AND autores.id_autor=libros_autores.autores_id_autor
        ORDER BY titulo";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
    }

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
              <?php  echo "<h2>Resultados de la busqueda por ".strtolower($seleccion)."</h2>"?>
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
                                 echo "<td>" . $row['titulo'] . "</td>";
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
