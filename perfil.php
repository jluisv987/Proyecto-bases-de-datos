<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    $usuario=$_GET['usuario'];

    $query="SELECT * FROM usuarios WHERE nombre_usuario='$usuario'";
    $result=$mysqli->query($query) or die($mysqli->error.__LINE__);
    $row = mysqli_fetch_array($result);
 ?>
    <div class="container p-4">
        <div class="card card-body">
            <div class="col-md-4">
                 <?php
                    echo "<p><b>Nombre: </b>".$row['nombre']." ".$row['apellido']."</p>";
                    echo "<p><b>Edad: </b>".$row['edad']."</p>";
                    echo "<p><b>Genero: </b>".$row['genero']."</p>";
                    echo "<p><b>País: </b>".$row['nacionalidad']."</p>";
                    echo "<p><b>Edad: </b>".$row['ocupacion']."</p>";
                    echo "<p><b>Correo: </b>".$row['correo']."</p>";
                ?>
            </div>

        </div>
        </div>
    </div>
<?php include('includes/footer.php');?>
