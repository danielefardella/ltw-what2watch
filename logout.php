<?php 
session_start();
session_unset(); //It deletes all the session reports when we've logged in
session_destroy();
header('Location: index.php');
?>