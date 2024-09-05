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
  <?php include './layouts/navbar.php'; ?>
  <!--page content -->
  <div class="container">
    <div class="row">
      <h1>ToDoList, la produttività nel modo <del>giusto</del> sbagliato</h1>
      <h2>Chi siamo?</h2>
      <p>Siamo <b>Roberto Pio Iannello</b> e <b>Luca Carossino</b> due studenti di Ingengeria informatica presso
        l'università degli studi di Genova</p>
      <h2>Il nostro obiettivo</h2>
      <p>Il nostro obiettivo è quello di fornirvi un servizio gratuito per la gestione delle cose da fare, in modo da
        gestire le cose da fare in modo facile e veloce</p>
      <h2>Perché?</h2>
      <p>Perchè ci serve fare un progetto per il corso di Sviluppo Applicazioni Web e ci sembrava qualcosa di carino e
        anche utile</p>
      <h2>E ora un po' di meme sulla programmazione web per riempire la pagina</h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-1">
          <img src="./images/memes/phpnono.png" class="mb-2" alt="Dog refusing php">
          <div class="card-content">
            <p class="text-center">Devo dire che alla fine php non è poi così male</p>
          </div>
        </div>
        <div class="card mb-1">
          <img src="./images/memes/javascriptframeworks.jpg" class="mb-2 alt=" Dog refusing php">
          <div class="card-content">
            <p class="text-center">Noi usiamo XAMPP, ma il meme era carino :)</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-1">
          <img src="./images/memes/dogememe.jpg" class="mb-2 alt=" Dog refusing php">
          <div class="card-content">
            <p class="text-center">Ma soprattutto non sappiamo come centrare un div</p>
          </div>
        </div>
        <div class="card mb-1">
          <img src="./images/memes/bartsimpson.jpg" class="mb-2 alt=" Dog refusing php">
          <div class="card-content">
            <p class="text-center">Questo progetto lo finiremo solo perchè è per un esame</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-1">
          <img src="./images/memes/htmlbaby.jpg" class="mb-2 alt=" Dog refusing php">
          <div class="card-content">
            <p class="text-center">Continuiamo a sentire gente che dice che HTML è un linguaggio di programmazione</p>
          </div>
        </div>
        <div class="card mb-1">
          <img src="./images/memes/htmlbatman.jpg" class="mb-2 alt=" Dog refusing php">
          <div class="card-content">
            <p class="text-center">No seriamente, abbiamo messo due meme su questo perché ancora tanta gente dice sta
              cavolata</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include './layouts/footer.php'; ?>
</body>

</html>
