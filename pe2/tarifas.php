<?php
require_once("pelicula.php");

// Obtener las películas de la base de datos
$peliculas = Pelicula::obtenerPeliculas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cines Moreno - Tarifas</title>
  <link rel="stylesheet" href="estilo.css">
  <meta charset="UTF-8">
</head>

<body>
  <header>
    <?php include("header.php"); ?>
  </header>

  <main>
    <section class="caja_horario_tarifas">
      <table>
        <thead>
          <tr>
            <th>Película</th>
            <th>General</th>
            <th>Estudiante</th>
            <th>Grupo</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($peliculas as $pelicula) {
            echo "<tr>";
            echo "<td>" . $pelicula->devolverValor("Titulo") . "</td>";
            echo "<td>8.00 €</td>";
            echo "<td>6.00 €</td>";
            echo "<td>5.00 €</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>


    <a href="#" class="boton-flotante"></a>
  </main>

  <footer>
    <?php include("footer.html"); ?>
  </footer>
</body>

</html>