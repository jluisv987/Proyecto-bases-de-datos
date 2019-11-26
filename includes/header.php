<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!--Bootstrap-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title></title>
  </head>
  <body>
      <nav class="navbar navbar-custom">
          <div class="container">
              <a href="index.php" class="navbar-brand">Buscador de libros</a>

              <?php
                session_start();
                if(isset($_SESSION["usuario"]))
                {
                    $usuario=$_SESSION['usuario'];
                    echo "<a href=\"formulario_agregar_libro.php\" class=\"navbar-brand\">Agregar libro</a>";
                    echo "<a href='perfil.php?usuario=".$usuario."' class=\"navbar-brand\">".$usuario."</a>";
                    echo "<a href=\"librero.php\" class=\"navbar-brand\">Tu librero</a>";
                    echo "<a href=\"logout.php\" class=\"navbar-brand\">Salir</a>";
                }
                else {
                    echo "<a href=\"login.php\" class=\"navbar-brand\">Entrar</a>";
                }
               ?>

          </div>
      </nav>
