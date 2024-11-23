<?php
include('conexion.php');

// Consulta SQL para obtener los 5 jugadores con mayor puntuación
$sql = "SELECT id, User AS username, Score FROM users ORDER BY Score DESC LIMIT 5"; // Cambia 'users' y las columnas según tu base de datos

// Ejecutar la consulta y manejar posibles errores
$result = $conn->query($sql);
if ($result === false) {
    die("Error executing query: " . $conn->error); // Manejo de errores si la consulta falla
}

// Crear un array de jugadores
$top_players = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $top_players[] = $row; // Almacenar los resultados en el array
    }
} else {
    echo "No players found.";
}

// Cerrar la conexión
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Dead Pixels - Echos of destiny </title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="manifest" href="manifest.json">

  </head>
<body>

  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <a href="index.php" class="logo">
                      <img src="assets/images/logo.jpg" alt="">
                    </a>
                    <ul class="nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="browse.php">Browse</a></li>
                        <li><a href="details.php">Details</a></li>
                        <li><a href="streams.php" class="active">Streams</a></li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>

                </nav>
            </div>
        </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
          <div class="row">
            <div class="col-lg-8">
              <div class="featured-games header-text">
  <div class="heading-section">
    <h4><em>Meet the</em> Developers</h4>
  </div>
  <div class="owl-features owl-carousel">
    <!-- Developer 1 -->
    <div class="item">
      <div class="thumb">
        <img src="assets/images/TSU TI González Real Alan Gabriel 1121150036 t.jpg" alt="Alan Gonzalez">
        <div class="hover-effect">
          <h6>App and Website Developer</h6>
        </div>
      </div>
      <h4>Alan Gonzalez<br><span>App and Website Developer</span></h4>
      <p>Responsible for creating the game's website, mobile application, and database.</p>
    </div>
    <!-- Developer 2 -->
    <div class="item">
      <div class="thumb">
        <img src="assets/images/raull.jpg" alt="Raul Ramirez">
        <div class="hover-effect">
          <h6>Game Developer</h6>
        </div>
      </div>
      <h4>Raul Ramirez<br><span>Game Developer</span></h4>
      <p>Designed and programmed the enemies within the game.</p>
    </div>
    <!-- Developer 3 -->
    <div class="item">
      <div class="thumb">
        <img src="assets/images/ash.jpg" alt="Ashley Ochoa">
        <div class="hover-effect">
          <h6>Game Developer</h6>
        </div>
      </div>
      <h4>Ashley Ochoa<br><span>Game Developer</span></h4>
      <p>Created and designed the game levels.</p>
    </div>
    <!-- Developer 4 -->
    <div class="item">
      <div class="thumb">
        <img src="assets/images/Alann.jpg" alt="Alan Portillo">
        <div class="hover-effect">
          <h6>Game Developer</h6>
        </div>
      </div>
      <h4>Alan Portillo<br><span>Game Developer</span></h4>
      <p>Designed and developed the main character.</p>
    </div>
    <!-- Developer 5 -->
    <div class="item">
      <div class="thumb">
        <img src="assets/images/Oscar.jpg" alt="Oscar Paez">
        <div class="hover-effect">
          <h6>Game Developer</h6>
        </div>
      </div>
      <h4>Oscar Paez<br><span>Game Developer</span></h4>
      <p>Designed the entire graphical user interface of the game.</p>
    </div>
  </div>
</div>
            <div class="col-lg-4">
                  <div class="top-streamers">
                      <div class="heading-section">
                          <h4><em>Top</em> Players</h4>
                      </div>
                      <ul>
                          <?php 
                          // Verificamos si hay jugadores en el array
                          if (!empty($top_players)) {
                              $rank = 1;
                              foreach ($top_players as $player) { 
                          ?>
                              <li>
                                  <span><?= str_pad($rank++, 2, '0', STR_PAD_LEFT); ?></span>
                                  <img src="assets/images/perfil.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                                  <h6><?= htmlspecialchars($player['username']); ?></h6>
                                  <div class="main-button">
                                      <span>Score: <strong><?= number_format($player['Score']); ?></strong></span>
                                  </div>
                              </li>
                          <?php 
                              }
                          } else {
                              echo "<li>No top players found.</li>";
                          }
                          ?>
                      </ul>
                  </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2024 <a href="#">Dead Pixels</a> Company. All rights reserved. 

        </div>
      </div>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
  </body>

</html>
