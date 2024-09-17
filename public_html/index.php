<!-- header and navbar -->
<?php include './layouts/navbar.php'; ?>
<!--page content -->

<div class="container-xl">
  <div class="row">
    <h1>
      Benvenuto su ToDoList!&#x1f389
    </h1>
    <p>
      Sei pronto a prendere il controllo della tua vita quotidiana? Con ToDoList, la gestione delle tue attività diventa un gioco da ragazzi! Qui puoi creare la tua To Do List personalizzata, dove ogni task è un passo verso il tuo successo.
    </p>
    <p>
      Immagina di poter aggiungere tasks con date di <b>scadenza</b>, impostare <b>promemoria</b> che ti avvisano quando è il momento di agire e persino creare <b>tasks ricorrenti</b> per quelle attività che si ripetono, come pagare le bollette o ricordarti di portare il cane a fare una passeggiata. &#128062
    </p>
    <p>
      La nostra <b>dashboard</b> intuitiva ti permette di <b>riordinare</b>i tuoi tasks in modo semplice e veloce, che tu voglia organizzarli per nome, stato, data di scadenza o altro ancora. Non dovrai più preoccuparti di dimenticare nulla! Con ToDoList, ogni attività avrà il suo posto e il suo momento.
    </p>
    <p>
      E non è tutto! Con la nostra interfaccia, gestire le tue attività diventa un'esperienza piacevole e motivante. Ogni volta che completi un task, potrai goderti la soddisfazione di spuntarlo dalla lista!
    </p>
    <p>
      Unisciti a noi e trasforma la tua routine in un'avventura organizzata. Con ToDoList, il tuo tempo è nelle tue mani!
      &#x2705
    </p>
  </div>
  <div class="row mb-3">
    <div class="col-md-3">
      <div class="card mb-3" style="height: 100%">
        <div class="card-body">
          <h5 class="card-title">Creare un Task</h5>
          <p class="card-text"> Per creare un task basta andare alla <a href="./dashboard.php">Dashboard</a> e cliccare sul pulsante "Nuovo Task", comparirà poi una schermata in cui potrai specificare tutti i dettagli del task prima di inserirlo nella tual lista!</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card mb-3" style="height: 100%">
        <div class="card-body">
          <h5 class="card-title">Creare un Progetto</h5>
          <p class="card-text">Per creare un progetto basta andare alla <a href="./dashboard.php">Dashboard</a> e cliccare sul pulsante "Nuovo Progetto", comparirà poi una schermata dove potrai inserire il nome del progetto</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3" style="height: 100%">
        <div class="card-body">
          <h5 class="card-title">Ricerca</h5>
          <p class="card-text"> Nella <a href="./dashboard.php">Dashboard</a> potrai cercare i tasks in base al nome, progetto o note in modo rapito attraverso la barra di ricerca, per tornare alla vista generale puoi cliccare sul tasto "Ripristina Ricerca"</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3" style="height: 100%">
        <div class="card-body">
          <h5 class="card-title">Promemoria</h5>
          <p class="card-text">Ogni task ha un bottone per impostare i promemoria, una volta impostata l'ora e il giorno, di verrà inviata una notifica all'orario da te scelto</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="card border-0 mb-3">
      <div class="row g-0">
        <div class="col-md-2">
          <img src="./images/profile.png" class="img-fluid rounded-start"
            alt="Versione Cartoon di un ragazzo al computer, paffutello, con occhiali, capelli e barba castani">
        </div>
        <div class="col-md-10">
          <div class="card-body">
            <h5 class="card-title">Chi sono?</h5>
            <p class="card-text">Sono un appassionato di tecnologia e software open source. Fin da piccolo, ho sempre avuto una curiosità innata per il mondo digitale e per tutto ciò che riguarda l'innovazione. Mi piace esplorare nuove idee e sperimentare con progetti che sfidano i confini della creatività. <br>

              Oltre alla mia passione per la tecnologia, sono un grande fan di anime e manga. Trovo che queste forme d'arte raccontino storie incredibili e offrano mondi fantastici da esplorare. Non posso resistere a una buona serie o a un manga avvincente! <br>

              Inoltre, i videogiochi Nintendo occupano un posto speciale nel mio cuore. Che si tratti di avventure epiche o di giochi più leggeri, ogni esperienza di gioco è un'opportunità per divertirsi e connettersi con altri appassionati.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-5 justify-content-center">
    <div class="col-md-6">
      <div id="carouselMemes" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./images/memes//bartsimpson.jpg" class="d-block w-100"
              alt="Bart Simpson che scrive alla lavagna che non inizierà più dei progetti extra finchè non completerà quelli iniziati">
          </div>
          <div class="carousel-item">
            <img src="./images/memes/dogememe.jpg" class="d-block w-100" alt="Immagine di un cane">
          </div>
          <div class="carousel-item">
            <img src="./images/memes/htmlbaby.jpg" class="d-block w-100" alt="Bebè che dice che HTML è un linguaggio di programmazione">
          </div>
          <div class="carousel-item">
            <img src="./images/memes/htmlbatman.jpg" class="d-block w-100" alt="Robin che dice che HTML è un linguaggio di programmazione e batman giustamente lo mena">
          </div>
          <div class="carousel-item">
            <img src="./images/memes/javascriptframeworks.jpg" class="d-block w-100" alt="Pagliaccio hit che invita un bambino a entrare in un tombino perchè ha un nuovo framework di javascript">
          </div>
          <div class="carousel-item">
            <img src="./images/memes/phpnono.png" class="d-block w-100" alt="Cane che rifiuta del cibo e sul cibo c'è scritto PHP">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- footer -->
<?php include './layouts/footer.php'; ?>
