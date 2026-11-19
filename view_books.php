<?php

require_once("./config/db.php");   // Conexión $conn

// Libros ordenados alfabéticamente por título
$query = "SELECT * FROM books ORDER BY title";
$consulta = $conn->prepare($query);
$consulta->execute();

// Libros ordenados alfabéticamente por autor
$query2 = "SELECT * FROM books ORDER BY author";
$consulta2 = $conn->prepare($query2);
$consulta2->execute();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Libros</title>
</head>

<body>
    <h1>Ver Libros</h1>
    <p><a href="insert_book.php">Añadir un nuevo libro</a></p>

    <h2>Libros ordenados alfabéticamente por título</h2>
    <table border="1" cellpadding="10" cellspacing="10">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Listado de libros
            foreach ($consulta as $row) {
            ?>
                <tr>
                    <td><?= $row["title"] ?></td>
                    <td><?= $row["author"] ?></td>
                    <td><a href="./delete_book.php?id=<?= $row["id"] ?>">Eliminar libro</a></td>
                </tr>
            <?php } 

            ?>
        </tbody>
    </table>

    <h2>Libros ordenados alfabéticamente por autor</h2>
    <table border="1" cellpadding="10" cellspacing="10">
        <thead>
            <tr>
                <th>Autor</th>
                <th>Título</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Listado de libros
            foreach ($consulta2 as $row) {
            ?>
                <tr>
                    <td><?= $row["author"] ?></td>
                    <td><?= $row["title"] ?></td>
                    <td><a href="./delete_book.php?id=<?= $row["id"] ?>">Eliminar libro</a></td>
                </tr>
            <?php } 

            ?>
        </tbody>
    </table>
</body>

</html>