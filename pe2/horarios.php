<?php
require_once("pelicula.php");

// Obtener las películas de la base de datos
$peliculas = Pelicula::obtenerPeliculas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cines Moreno - Horarios</title>
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
            <th>Horario</th>
            <th>Sala</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($peliculas as $pelicula) {
            echo "<tr>";
            echo "<td>" . $pelicula->devolverValor("Titulo") . "</td>";
            echo "<td>11:00 AM</td>";
            echo "<td>Sala 1</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
      <p>*Este horario será efectivo de Lunes a Viernes. Los fines de semana "Cines Moreno" permanecerá cerrado.</p>
    </section>

    <a href="#" class="boton-flotante"></a>
  </main>

  <footer>
    <?php include("footer.html"); ?>
  </footer>
</body>

</html>