<!doctype html>
<html lang="it">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ToDoList</title>
  <link href="./css/bootstrap.css" rel="stylesheet" />
  <link href="./css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Including bootsrap javascript -->
  <script src="./js/bootstrap.bundle.js" crossorigin="anonymous"></script>
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
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./dashboard.php">Dashboard</a>
        </li>
      </ul>
      <form class="d-flex">
        <?php 
        session_start();
        if(isset($_SESSION['session_id'])) {
          echo '<a href="./php/logout.php">
          <button class="btn btn-outline-danger me-2" type="button">
            Logout
          </button>
        </a>';
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
