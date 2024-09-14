<!doctype html>
<html lang="it">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ToDoList</title>
  <link href="./css/bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="./css/styles.css" rel="stylesheet" />

  <!-- favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
  <link rel="manifest" href="./favicon/site.webmanifest">
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Including bootsrap javascript -->
  <script src="./js/bootstrap.bundle.js" crossorigin="anonymous"></script>
  <!-- Including jquery -->
  <script src='../js/jquery-3.7.1.min.js' crossorigin="anonymous"></script>
  <!-- Including DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />

  <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">
        <img src="./images/check2-square.svg" alt="Checkbox logo" width="30" height="30" />
        ToDoList
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
            </li>
            <?php
              session_start();
              if (isset($_SESSION['session_id'])) {
                echo '
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./dashboard.php">Dashboard</a>
                </li>';} 
            ?>
        </ul>
        <form class="d-flex">
          <?php
          if (isset($_SESSION['session_id'])) {
            echo '
            <a href="./profile.php">
              <button class="btn btn-outline-primary me-2" type="button">
                Profilo 
              </button>
            </a>
            <a href="./php/logout.php">
              <button class="btn btn-outline-danger me-2" type="button">
                Logout
              </button>
            </a>
            ';
          } else {
            echo '<a href="./login.php">
            <button class="btn btn-outline-success me-2" type="button">
              Login
            </button>
          </a>
          <a href="./registration.php">
            <button class="btn btn-outline-success me-2" type="button">
              Registrati
            </button>
          </a>';
          }
          ?>
        </form>
      </div>
    </div>
  </nav>
