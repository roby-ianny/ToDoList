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
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img
                                src="./images/check2-square.svg"
                                alt="Checkbox logo"
                                width="30"
                                height="30"
                            />
                            ToDoList
                        </a>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div
                            class="collapse navbar-collapse"
                            id="navbarSupportedContent"
                        >
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        aria-current="page"
                                        href="./index.php"
                                        >Home</a
                                    >
                                </li>
                            </ul>
                            <form class="d-flex">
                                <a href="./login.php">
                                    <button
                                        class="btn btn-outline-success me-2"
                                        type="button"
                                    >
                                        Login
                                    </button>
                                </a>
                                <a href="./registration.php"> <button class="btn btn-outline-success me-2"
                                        type="button"
                                    >
                                        Register
                                    </button>
                                </a>
                            </form>
                        </div>
                    </div>
                </nav>



        <!--page content -->
        <div class="container">
            <class="row justify-content-center">
                <h1>Registrati</h1>
                <form action="./php/register.php" method="post">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="firstname" >
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Cognome</label>
                        <input type="text" class="form-control" name="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass">
                    </div>
                    <div class="mb-3">
                        <label for="confirm" class="form-label">Conferma Password</label>
                        <input type="password" class="form-control" name="confirm">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit" value="Registrati">Registrati</button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="mt-auto bg-dark text-white text-center">
                   <div class="container">
                    <p class="text-align-center">&COPY; 2024 Copyright: Roberto Pio Iannello e Luca Carossino</p>
                   </div>
        </footer>
    </body>
</html>
