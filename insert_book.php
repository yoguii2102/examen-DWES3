<?php

require_once("./config/db.php");   // Conexión $conn

$msg = "";

// Si se envió el formulario POST guardamos el libro
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $author = $_POST["author"];

    $query = "INSERT INTO books (title, author) VALUES (:title, :author)";
    $consulta = $conn->prepare($query);
    $consulta->bindParam(":title", $title);
    $consulta->bindParam(":author", $author);

    if ($consulta->execute()) {
        $msg = "Libro añadida con éxito";
    } else {
        $msg = "No se ha podido añadir el libro";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir libro</title>
</head>

<body>
    <h1>Añadir libro</h1>
    <p><a href="view_books.php">Listado de libros</a></p>
    <?php
    // Imprimir mensaje de éxito si se ha guardado el libro
    if ($msg != "") {
    ?>
        <p><?= ($msg) ?></p>
    <?php
    }
    ?>
    <form action="" method="post">
        <label for="title">Título:
            <input type="text" name="title">
        </label>
        <br><br>
        <label for="author">Autor:
            <input type="text" name="author">
        </label>
        <br><br>

        <input type="submit" name="submit" value="Añadir Libro">

    </form>
</body>

</html>