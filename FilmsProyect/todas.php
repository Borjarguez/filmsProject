<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header('location:login.html');
    return;
}

$user = $_SESSION['currentUser']['user'];

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {
    $connection = new mysqli('localhost', 'DBUSER2018', 'DBPSWD2018');
    $connection->select_db('BD');

    $query = $connection->prepare('SELECT * FROM film');
    $query->bind_result($title, $year, $genre, $director, $id);
    $query->execute();

    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Todas</title>
        <meta name="author" content="Borja Rodriguez">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-3.4.0.min.js"></script>
        <script src="score.js"></script>
        <script src="notify.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <header>
            <h1>Todas las peliculas</h1>
            <nav>
                <a title="Página principal" accesskey="r" tabindex="1" href="todas.php">Pagina Principal</a>
                <a title="Ayuda" accesskey="a" tabindex="2" href="Ayuda/Ayuda_todas.html">Ayuda</a>
                <a title="Favoritas" accesskey="f" tabindex="3" href="favoritas.php">Favoritas</a>
                <a title="Cines" accesskey="c" tabindex="4" href="cines.html">Cines</a>
                <a title="Premios" accesskey="p" tabindex="5" href="premios.php">Premios</a>
            </nav>
        </header>
        <table class="peliculas">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Año</th>
                    <th>Genero</th>
                    <th>Director</th>
                    <th>Puntuacion</th>
                    <th>Favorita</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query->store_result();
                $queryF = $connection->prepare('SELECT COUNT(*) FROM favourites WHERE film_id=? AND user_id=?');
                while ($query->fetch()) {
                    $queryF->bind_param('ss', $id, $user);
                    $queryF->bind_result($numero);

                    $queryF->execute();
                    $favorita = false;
                    if ($queryF->fetch()) {
                        $favorita = $numero > 0;
                    }

                    ?>
                    <tr>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $year; ?></td>
                        <td><?php echo $genre; ?></td>
                        <td><?php echo $director; ?></td>
                        <td class="score" data-imdbID="<?php echo $id; ?>"></td>
                        <td>
                            <?php if ($favorita) { ?>
                                Favorita
                            <?php } else { ?>
                                <a onclick="nota.spawnNotification('Acabas de añadir esta pelicula a favoritas')" href="aniadir.php?id=<?php echo $id ?>">Marcar como favorita</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
            }
            $query->free_result();
            $connection->close();
        } catch (mysqli_sql_exception  $e) {
            header('location:error.php?mensaje=' . urlencode($e->getMessage()));
        }
        ?>
        </tbody>
    </table>

    <footer>
        <a href="https://validator.w3.org/check?uri=referer">
            <img src="https://www.w3.org/html/logo/badge/html5-badge-h-solo.png" alt=" HTML5 Válido!" height="64" width="63" /> </a>

        <a href=" https://jigsaw.w3.org/css-validator/check/referer ">
            <img src=" https://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" height="31" width="88" /></a>
    </footer>
</body>

</html>