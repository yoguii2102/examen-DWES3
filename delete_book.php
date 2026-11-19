<?php

require_once("./config/db.php");   

$id = $_GET["id"];            // id del libro a borrar
$borrado = false;

// Buscamos el libro para conocer su título y su autor
$query = "SELECT * FROM books WHERE id=:id";
$consulta = $conn->prepare($query);
$consulta->bindParam(":id", $id);
$consulta->execute();

// fetch() coge UNA fila. Si no hay ninguna con ese id, devuelve false.
$row = $consulta->fetch(PDO::FETCH_ASSOC);

// Si el libro existe y se ha confirmado el borrado
if ($row && isset($_GET["borrar"]) && $_GET["borrar"] == 1) {

    $query = "DELETE FROM books WHERE id = :id";
    $consulta = $conn->prepare($query);
    $consulta->bindParam(":id", $id);

    if ($consulta->execute()) {
        $borrado = true;
        $msg = "Borrado realizado correctamente.";
    } else {
        $msg = "Error al ejecutar el borrado.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar libro</title>
</head>

<body>
    <h1>Borrar libro</h1>
    <p><a href="view_books.php">Listado de libros</a></p>
    <?php
   

    if ($borrado) {
    ?>
        <p><?= $msg ?></p>
        <p><a href="./view_books.php">Volver al listado</a></p>
    <?php
    } elseif ($row) {
    ?>
        <!-- Mostrar la información del libro -->
        <p><?= $row["title"] ?>,<?= $row["author"] ?></p>
        
        <!-- otro para cancelar dicho borrado -->
        <p><a href="./view_books.php">cancelar</a></p>
        
        <!-- uno para conformar el borrado -->
        <p><a href="./delete_book.php?id=<?= $id ?>&borrar=1">Borrar</a></p>

    <?php } else { ?>
        <p>Libro no encontrado.</p>
        <p><a href="./view_books.php">Volver al listado</a></p>
    <?php }
    ?>
</body>

</html>