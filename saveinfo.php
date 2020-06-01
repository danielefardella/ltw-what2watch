<?php
if(isset($_POST['sendbutton'])) {
    require 'dbconnect.php';
    session_start();

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
    $query = "INSERT INTO movies (title,plot,director,year_release,ratingimdb,postimglink,coverimglink,genres,duration,ytlink) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)";
    $data = pg_query_params($dbconn,$query,array($title,$plot,$director,$yearr,$imdb,$postimg,$coverimg,$genres,$duration,$ytlink));

    if(data) {
        $_SESSION['successpost'] = 'The trailer added successefully';
        header('Location: admin.php');
    }
    else{
        $_SESSION['notsuccesspost'] = 'The trailer not added successefully';
        header('Location: admin.php');
    }
    
    pg_close($dbconn); // Close the connection
} 
else {
    header('Location: index.php');
}

?>