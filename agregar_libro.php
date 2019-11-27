<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php

$query_tipo="SELECT tipo, id_tipo FROM tipos";
$query_genero ="SELECT genero, id_generos FROM generos";
$result_tipo= $mysqli->query($query_tipo) or die($mysqli->error.__LINE__);
$result_genero= $mysqli->query($query_genero) or die($mysqli->error.__LINE__);
?>
<?php
$confirma=1;
if (isset($_POST['boton'])) {
    if($_POST['titulo']=="")
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        Error, ingrese un titulo valido
        </div>";
        $confirma=0;
    }
    if($_POST['ISBN13']=="" or strlen($_POST['ISBN13'])!=13)
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        Error, ingrese un ISBN13 valido con 13 numeros
        </div>";
        $confirma=0;
    }
    if($_POST['descripcion']=="")
    {
        $_POST['descripcion']="Sin descripcion";

    }
    if($_POST['nombre']=="")
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        Error, ingrese un nombre de autor valido
        </div>";
        $confirma=0;
    }

    if($_POST['apellido']=="")
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
        Error, ingrese un apellido de autor valido
        </div>";
        $confirma=0;
    }
    if(!(isset($_POST['tipos'])))
    {

            echo "<div class=\"alert alert-danger\" role=\"alert\">
            Error, ingrese al menos un tipo de libro
            </div>";
            $confirma=0;
    }
/*    else {
        if (is_array($_POST['tipos']))
        {
          foreach($_POST['tipos'] as $value)
          {
            echo " Tipo ".$value;

          }
        }
        else
        {
          $value = $_POST['tipos'];
          echo " Tipo ".$value;

        }

    }*/

    if(!(isset($_POST['generos'])))
    {

            echo "<div class=\"alert alert-danger\" role=\"alert\">
            Error, ingrese al menos un genero de libro
            </div>";
            $confirma=0;

    }
/*    else {
        if (is_array($_POST['generos']))
        {
          foreach($_POST['generos'] as $value)
          {
            echo " Genero ".$value;

          }
        }
        else
        {
          $value = $_POST['generos'];
          echo " Genero ".$value;

        }

    }*/
    if(isset($_FILES['portada']))
    {

        if(!(getimagesize($_FILES['portada']['tmp_name'])==FALSE))
        {

            $imagen = $_FILES['portada']['tmp_name'];
        	$imagen = file_get_contents($imagen);
            $imagen = addslashes($imagen);
            //$imagen = base64_encode($imagen);

        }


    }
    if($confirma==1)
    {
        $titulo=$_POST['titulo'];
        $ISBN13=$_POST['ISBN13'];
        $descripcion=$_POST['descripcion'];
        $query="SELECT titulo FROM libros WHERE titulo ='".$_POST['titulo']."'";
        $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
        if(mysqli_num_rows($result)>=1)
        {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            Error, el libro que intentas subir ya esta en la base de datos
            </div>";
        }
        else {
            //ingresar nuevo libro
            $query="INSERT INTO libros(titulo, isbn13, descripcion, portada) VALUES ('$titulo', '$ISBN13', '$descripcion','".$imagen."')";
            $result= $mysqli->query($query) or die($mysqli->error.__LINE__);

            $query="SELECT id_autor FROM autores WHERE apellido_autor = '".$_POST['apellido']."' AND nombre_autor = '".$_POST['nombre']."'";
            $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
            if(mysqli_num_rows($result)>=1)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $id_autor = $row['id_autor'];

                }
            }
            else {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $query="INSERT INTO autores(nombre_autor,apellido_autor) VALUES ('$nombre', '$apellido')";
                $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
                $query="SELECT id_autor FROM autores WHERE apellido_autor = '".$_POST['apellido']."' AND nombre_autor = '".$_POST['nombre']."'";
                $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
                while($row = mysqli_fetch_array($result))
                {
                    $id_autor = $row['id_autor'];
                }

            }
            $query="SELECT id_libro FROM libros WHERE titulo ='".$_POST['titulo']."'";
            $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
            while($row = mysqli_fetch_array($result))
            {
                $id_libro = $row['id_libro'];
            }
            // este query relaciona el autor con el libro
            $query="INSERT INTO libros_autores(libros_id_libro, autores_id_autor) VALUES ('$id_libro', '$id_autor')";
            $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
            if(isset($_POST['tipos']))
            {
              if (is_array($_POST['tipos']))
              {
                foreach($_POST['tipos'] as $value)
                {
                  $query="INSERT INTO tipos_libros (tipos_id_tipo, libros_id_libro) VALUES ('$value', '$id_libro')";
                  $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
                }
              }
              else
              {
                $value = $_POST['tipos'];
                $query="INSERT INTO tipos_libros (tipos_id_tipo, libros_id_libro) VALUES ('$value', '$id_libro')";
                $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
              }
            }

            if(isset($_POST['generos']))
            {
              if (is_array($_POST['generos']))
              {
                foreach($_POST['generos'] as $value)
                {
                  $query="INSERT INTO generos_libros(libros_id_libro, generos_id_generos) VALUES ('$id_libro','$value')";
                  $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
                }
              }
              else
              {
                $value = $_POST['generos'];
                $query="INSERT INTO generos_libros(libros_id_libro, generos_id_generos) VALUES ('$id_libro','$value')";
                $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
              }
            }
            echo "<div class=\"alert alert-success\" role=\"alert\">
            Libro agregado excitosamente a tu perfil
            </div>";
        }
    }
}
 ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-10">
        <!--busqueda-->
            <div class="card card-body">
                <form  class="form_search" method="post" action="agregar_libro.php" enctype="multipart/form-data">
                    <p>* Campos obligatorios</p>
                    <p>Titulo *</p>
                    <input type="text" name="titulo" class="form-control">
                    <p>ISBN13 *</p>
                    <input type="text" name="ISBN13" class="form-control">
                    <p>Descripción</p>
                    <input type="text" name="descripcion" class="form-control">
                    <p>Portada *</p>
                    <input type="file" name="portada">
                <h5>Autor principal</h5>
                <div class="row">

                    <div class="col-md-6">

                        <p>Nombre *</p>
                        <input type="text"
                        name="nombre" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <p>Apellido *</p>
                        <input type="text" name="apellido"
                        class="form-control">
                    </div>
                </div>
                <h5>Tipos *</h5>
                <div class="row">
                <?php
                    while($row = mysqli_fetch_array($result_tipo))
                    {
                        echo '<div class="col-md-2">';
                        echo '<input type="checkbox" class="form-control" name="tipos[]" value="'.$row['id_tipo'].'"/>'.$row['tipo'];
                        echo '</div>';
                    }
                 ?>
                </div>

                <h5>Generos *</h5>
                <div class="row">
                <?php
                    while($row = mysqli_fetch_array($result_genero))
                    {
                        echo '<div class="col-md-2">';
                        echo '<input type="checkbox" class="form-control" name="generos[]" value="'.$row['id_generos'].'"/>'.$row['genero'];
                        echo '</div>';
                    }
                 ?>
                 </div>
                    <input type="submit" name="boton" value="Agregar" class="form-control">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
