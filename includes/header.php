  <!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">

    <title>DuckLove</title>
  </head>


  <body>
    
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6FD084;">
        <div class="navbar-collapse form-inline" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-item nav-link disabled" href="index.php"><img src="images/logo_duck.png" width="60" height=60" class="d-inline-block align-top" alt="Accueil"></a>
            </li>
            <li class="nav-item">
              <a class="nav-item nav-link disabled" href="index.php">Accueil </a>
            </li>
            <?php
            if (isset($_SESSION['pseudo']))
              echo '<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="profil.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                href="profil.php">'.$_SESSION['pseudo'].'
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profil.php">Profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="deconnexion.php">Deconnexion</a>
              </div></li>
            ';
            else
              echo '<li class="nav-item">
              <a class="nav-item nav-link disabled" href="page_connexion.php">Connexion</a>
              </li>
              ';
            ?>
        </ul>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div> 
      </nav>
      <div class="container">