<?php 
if(isset($_POST['updatebutton'])) {
    require 'dbconnect.php';
    session_start();
    $idmov = $_POST['movie-id'];
    $title = $_POST['title'];
    $plot = $_POST['description'];
    $director = $_POST['director'];
    $yearr = $_POST['year'];
    $imdb = $_POST['imdb'];
    $postimg = $_POST['imglink'];
    $coverimg = $_POST['bigimglink'];
    $genres = $_POST['gen'];
    $duration = $_POST['duration'];
    $ytlink = $_POST['ytlink'];
    $genres = implode(',',$genres);
    $genres = "{".$genres."}";

    //echo '<br>' . $idmov . '<br><br>';

    //echo $idmov . $title .  $plot . $director. '<br>' . $yearr . $postimg . $coverimg . '<br>' . $ytlink . $genres;
    $q = 'UPDATE movies 
            SET title = $1,
            plot = $2,
            director = $3,
            year_release = $4,
            ratingimdb = $5,
            postimglink = $6,
            coverimglink = $7,
            genres = $8,
            duration = $9,
            ytlink = $10 
            WHERE movie_id = $11';
    $qrun = pg_query_params($dbconn,$q,array($title,$plot,$director,$yearr,$imdb,$postimg,$coverimg,$genres,$duration,$ytlink,$idmov)) or die ('Query failed ' . pg_last_error());

    if($qrun) {
        $_SESSION['successedit'] = 'The trailer updated successefully';
        header('Location: admin.php');
    }
    else {
        $_SESSION['erroredit'] = 'The trailer is not updated successefully';
        header('Location admin.php');
    }

}
else {
    header('Location: index.php');
}

?>