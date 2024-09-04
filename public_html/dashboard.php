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
    <?php include "./layouts/navbar.php"; ?>
    <!--page content -->
    <?php include "./php/checksession.php" ?>
    <!-- footer -->
    <?php include "./layouts/footer.php"; ?>
</body>

</html>