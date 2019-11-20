<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php

$query_tipo="SELECT tipo FROM tipos";
$query_genero ="SELECT genero FROM generos";
$result_tipo= $mysqli->query($query_tipo) or die($mysqli->error.__LINE__);
$result_genero= $mysqli->query($query_genero) or die($mysqli->error.__LINE__);
?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-10">
        <!--busqueda-->
            <div class="card card-body">
                <form  class="form_search" method="post" action="agregar_libro.php" enctype="multipart/form-data">
                    <p>Titulo</p>
                    <input type="text" name="titulo" class="form-control">
                    <p>ISBN13</p>
                    <input type="text" name="ISBN13" class="form-control">
                    <p>Descripción</p>
                    <input type="text" name="descripcion" class="form-control">
                    <p>Portada</p>
                    <input type="file" name="portada">
                <h5>Autor principal</h5>
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
                <h5>Tipos</h5>
                <div class="row">
                <?php
                    while($row = mysqli_fetch_array($result_tipo))
                    {
                        echo '<div class="col-md-2">';
                        echo '<input type="checkbox" class="form-control" name="tipos" value="'.$row['tipo'].'"/>'.$row['tipo'];
                        echo '</div>';
                    }
                 ?>
                </div>

                <h5>Generos</h5>
                <div class="row">
                <?php
                    while($row = mysqli_fetch_array($result_genero))
                    {
                        echo '<div class="col-md-2">';
                        echo '<input type="checkbox" class="form-control" name="generos" value="'.$row['genero'].'"/>'.$row['genero'];
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
