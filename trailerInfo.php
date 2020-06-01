<?php 
if(isset($_POST['postID'])) {
    require 'dbconnect.php';

    $movvar = $_POST['postID'];
    $show = '';
    $genres = array();
    $query = 'SELECT title,plot,director,ratingimdb,postimglink,unnest(genres),duration,ytlink FROM movies WHERE movie_id = $1';
    $result = pg_query_params($dbconn,$query,array($movvar)) or die("Query movie info failed" . pg_last_error());
    while ($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
        foreach($line as $indx => $val) {
            if($indx == 'unnest'){
                $genres[] = $val;
            }
        }
    $newstring = implode( ", ", $genres );
    $title = $line['title'];
    $plot = $line['plot'];
    $director = $line['director'];
    $ratingimdb = $line['ratingimdb'];
    $postimglink = $line['postimglink'];
    $duration = $line['duration'];
    $ytlink = $line['ytlink'];
}

$show .= '<div class="card mb-3">
<div class="row no-gutters">
  <div class="col-md-4" style="max-width:200px;">
    <img src="'.$postimglink.'" class="card-img" alt="'.$title.'" style="height:287px; width:200px;"><br>
    <div style="text-align:center; padding-top:10px; padding-bottom:10px;border-right:1px solid rgba(0,0,0,.1);">
    <span class="bg-dark text-white rounded p-1"><i class="fas fa-star" style="color:#f5c518;"></i> IMDB Rating: '.$ratingimdb.'</span>
    <hr>
    <strong>Director: </strong> '.$director.'
    <hr>
    <strong>Genres: </strong> '.$newstring.' 
    <hr>
    <strong>Duration: </strong> '.$duration.'
    </div>
  </div>
  <div class="col-md-8">
    <div class="card-body">
      <h5 class="card-title">Plot</h5>
      <p class="card-text">'.$plot.'</p>
      <h5 class="card-title">Trailer</h5>
      <iframe id="getyt" src="https://www.youtube.com/embed/'.$ytlink.'" width="500" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>
  </div>
</div>
</div>';

echo $show;
pg_free_result($result); // Free the memory
pg_close($dbconn); // Close the connection

}
else {
    header('Location: index.php');

}

//close connection
?>
