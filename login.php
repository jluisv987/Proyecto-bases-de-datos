<?php include('includes/database.php');?>
<?php include('includes/header.php');?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-10">

            <div class="card card-body">
                <form  class="form_search" method="post" action="loguear.php" enctype="multipart/form-data">
                    <p>Usuario</p>
                    <input type="text" name="usuario" class="form-control">
                    <p>Contraseña</p>
                    <input type="text" name="contrasena" class="form-control">
                    <input type="submit" name="boton" value="Entrar" class="form-control">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
