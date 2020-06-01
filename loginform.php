<?php
if(isset($_POST['loginsubmit'])) {
    require 'dbconnect.php';
    $email = $_POST['email'];
    $q1="SELECT * FROM users WHERE email= $1";
    $result=pg_query_params($dbconn, $q1, array($email));
    if (!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){ //Checks if the object is empty or not
        header ('Location: login.php?error=email');
    }
    else {
        $password = md5($_POST['passwordlogin']);
        $q2="SELECT * FROM users WHERE email = $1 AND password_user = $2";
        $result=pg_query_params($dbconn, $q2, array($email, $password));
        if (!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
            header ('Location: login.php?error=password');
        }
        else {
            session_start();
            $_SESSION['sessionUser'] = $line['username'];
            $_SESSION['sessionemail'] = $line['email'];
            $_SESSION['sessionrole'] = $line['role_user'];
            header('Location: admin.php');
        }
    }

}
else {
    header ('Location: index.php');
}


?>