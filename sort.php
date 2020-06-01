<?php
if(isset($_POST['genere'])){
    require 'dbconnect.php';
    $sortfor = $_POST['genere'];

    function toSort($gentoSearch){
        $show = '';
        $noshow = "<h2>We're Sorry, no movies are found in ".$gentoSearch." genre </h2>";
        if ($gentoSearch == 'All genres'){
            $query = 'SELECT * FROM movies order by random() LIMIT 15';
        }
        else {
            $query = "SELECT * FROM movies WHERE '$gentoSearch' = any(genres) ORDER BY random() LIMIT 15";
        }
        $result = pg_query($query) or die ('Query is failed' . pg_last_error());
        $numRow = pg_num_rows($result);
        if($numRow == 0){
            return $noshow;
        }
        else {
            while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                $show .= 
                '<div class="col mb-4">
                    <div class="card" style="background:#32363a;">
                        <a href="" data-id="'.$line['movie_id'].'" data-title="'.$line['title'].' ('.$line['year_release'].')" class="movieopen"><img src="'.$line['postimglink'].'" class="card-img-top" alt="'.$line['title'].'" style="max-height:300px;"></a>
                        <div class="card-body" style="padding:10px;">
                        <a href="" data-id="'.$line['movie_id'].'" data-title="'.$line['title'].' ('.$line['year_release'].')" class="movieopen"><h5 class="card-title">'.$line['title'].'</h5></a>
                        </div>
                    </div>
                </div>';
            }
        }
        return $show;
        pg_free_result($result); // Free the memory
        pg_close($dbconn); // Close the connection
    }

    //$q1 = "SELECT * FROM movies WHERE 'Horror'=any(genres)";
    switch ($sortfor) {
        case 'All genres':
            $toprint = toSort('All genres');
            echo $toprint;
        break;
        case 'Action':
            $toprint = toSort('Action');
            echo $toprint;
        break;
        case 'Adventure':
            $toprint = toSort('Adventure');
            echo $toprint;
        break;
        case 'Comedy':
            $toprint = toSort('Comedy');
            echo $toprint;
        break;
        case 'Crime':
            $toprint = toSort('Crime');
            echo $toprint;
        break;
        case 'Romance':
            $toprint = toSort('Romance');
            echo $toprint;
        break;
        case 'Drama':
            $toprint = toSort('Drama');
            echo $toprint;
        break;
        case 'Fantasy':
            $toprint = toSort('Fantasy');
            echo $toprint;
        break;
        case 'Animation':
            $toprint = toSort('Animation');
            echo $toprint;
        break;
        case 'Horror':
            $toprint = toSort('Horror');
            echo $toprint;
        break;
        case 'Sci-fi':
            $toprint = toSort('Sci-fi');
            echo $toprint;
        break;
        default:
            $toprint = toSort('All genres');
            echo $toprint;
            //return all movies, to protect from modify.

    }

}

else {
    header('Location: index.php');
}

?>