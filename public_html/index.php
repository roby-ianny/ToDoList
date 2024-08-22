<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./css/styles.css" rel="stylesheet">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TodoList</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
          <a class="nav-link" href="#">Features</a>
          <a class="nav-link" href="#">Pricing</a>
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </div>
      </div>
    </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <h1>Chi siamo</h1>
        <p>Siamo un piccolo team di due personoe che pensa che per essere produttivi non serva uno strumento supercomplicato, ma basta una semplice lista di cose da fare, anche perché sappiamo fare solo quello</p>
      </div>
      <div class="row">
        <div class="col">
          <h2>Luchino</h2>
          <img src="https://blush.design/api/download?shareUri=uU1hUzS6DXo9s1MY&c=Skin_0%7Eedb98a&w=200&h=200&fm=png" alt="Avatar of a Man with a had and an eyepatch like a pirate" class="img-fluid float-start">
          <p>Mi piace l'ingegneria in generale, e anche i pirati, nel tempo libero gioco ai videogiochi e smonto moto. Forza Genoa.</p>
        </div>
        <div class="col">
          <h2>Robertino</h2>
          <img src="https://blush.design/api/download?shareUri=9N6tO9oQnvawVgou&c=Skin_0%7Eedb98a&bg=ffffff&w=200&h=200&fm=png" alt="Avatar of a man with beard and glasses" class="img-fluid float-start">
          <p>Amante del software Libero e Linux user di lunga data, nel tempo libero entro in fissa con qualcosa per un paio di mese per poi cambiare completamente hobby</p>
        </div>
      </div>

    </div>

  </body>
</html>