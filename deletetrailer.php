<?php
if(isset($_POST['deletebutton'])) {
    require 'dbconnect.php';
    session_start();
    $id = $_POST['idtrailer'];
    $q = 'DELETE FROM movies WHERE movie_id = $1';
    $qrun = pg_query_params($dbconn,$q,array($id)) or die('Query failed, removing trailer ' . pg_last_error());

    if($qrun) {
        $_SESSION['success'] = 'The trailer removed successfully';
        header('Location: admin.php');
    }
    else {
        $_SESSION['notsuccess'] = 'The trailer not removed successfully';
        header('Location: admin.php');
    }
}
else {
    header('Location: index.php');
}
?>