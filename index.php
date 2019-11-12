<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    $query="SELECT titulo,portada FROM libros";
    //Consigue los titulos
    $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
 ?>
    <nav class="navbar navbar-custom">
        <div class="container">
            <a href="index.php" class="navbar-brand">Buscador de libros</a>
        </div>
    </nav>


    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
            <!--busqueda-->
                <div class="card card-body">

                    <div class="form-group">
                      <label for="Tipos de busqueda">Tipos de busqueda</label>
                    </div>
                    <div class="form-group">
                      <select class="form-control" >
                        <option>Titulo</option>
                        <option>Autor</option>
                        <option>Genero</option>
                        <option>ISNB13</option>
                        <option>Tipo</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <button type="button"
                        class="btn btn-primary">Buscar</button>
                    </div>
                </div>

            </div>
            <!--Mostrar libros-->
            <div class="col-md-8" >
                <table class="table table-striped">
                      <thead style="background: #5CA4A9">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                    </thead >
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>
            </div>
        </div>
    </div>

<?php include('includes/footer.php');?>
