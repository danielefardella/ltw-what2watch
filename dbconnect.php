<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=what2watch user=postgres password=sapienza")
or die ('Could not connect: ' . pg_last_error());
?>