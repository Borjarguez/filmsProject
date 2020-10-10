<?php

$servername = "localhost";
$username = "DBUSER2018";
$password = "DBPSWD2018";
$database = "BD";
$usuarios = "user";
$peliculas = "film";
$favoritas = "favourites";

try {
    $connection = new mysqli($servername, $username, $password);
    $crearbase = "CREATE DATABASE IF NOT EXISTS " . $database . " COLLATE utf8_spanish_ci";
    $connection->query($crearbase);

    $connection->select_db($database);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LA TABLA USER // 

    $crearTabla = "CREATE TABLE IF NOT EXISTS " . $usuarios . " (
        name varchar(64) NOT NULL,
        email varchar(64) NOT NULL,
        password varchar(256) NOT NULL,
            PRIMARY KEY (email))";

    $connection->query($crearTabla);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LAS TABLA FILMS // 

    $crearTabla2 = "CREATE TABLE IF NOT EXISTS " . $peliculas . " (
        titulo varchar(50) NOT NULL,
        anio int(11) NOT NULL,
        genero varchar(50) NOT NULL,
        director varchar(50) NOT NULL,
        id varchar(50) NOT NULL,
            PRIMARY KEY (id))";

    $connection->query($crearTabla2);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LAS PELICULAS // 

    $crearPeliculas = 'INSERT INTO film (titulo,anio,genero,director,id) VALUES ("Titanic", 1997,"Drama","James Cameron","tt0120338")';
    $connection->query($crearPeliculas);

    $crearPeliculas2 = ' INSERT INTO film(titulo, anio,genero,director,id) VALUES("Love Actually", 2003,"Romance","Richard Curtis", "tt0314331")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("P.S. I Love You",2007,"Romance","Richard LaGravenese","tt0431308")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("The Pursuit of Happyness", 2006, "Drama", "Gabriele Muccino", "tt0454921")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("I Am Legend", 2007,"Drama","Francis Lawrence","tt0480249"),("The Avengers", 2012, "Action", "Joss Whedon", "tt0848228")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("The Avengers", 2012, "Action", "Joss Whedon", "tt0848228")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("Iron Man 3", 2013, "Action", "Shane Black", "tt1300854")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("Fury", 2014, "History", "David Ayer", "tt2713180")';
    $connection->query($crearPeliculas);

    $crearPeliculas = 'INSERT INTO film(titulo,anio,genero,director,id) VALUES("Dunkirk", 2017, "History", "Christopher Nolan", "tt5013056")';
    $connection->query($crearPeliculas);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LAS TABLA FAVOURITES // 

    $crearFavoritas = "CREATE TABLE IF NOT EXISTS " . $favoritas . " (
        user_id varchar(50) NOT NULL,
        film_id varchar(50) NOT NULL,
        FOREIGN KEY (film_id) REFERENCES film(Id),
        FOREIGN KEY (user_id) REFERENCES user(Email))";

    $connection->query($crearFavoritas);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header(' location: error . php ? mensaje =' . urlencode($e->message));
}
