<?php
if(isset($_POST['postID'])) {

    require 'dbconnect.php';
    session_start();
    function checkChecked($genre,$arrayGen){
        if(in_array($genre,$arrayGen)){
            return true;
        }
        else{
            echo false;
        }
    }
    $genres = array();
    $idmov = $_POST['postID'];
    $q = 'SELECT movie_id,title,plot,director,year_release,ratingimdb,duration,postimglink,coverimglink,unnest(genres),ytlink FROM movies WHERE movie_id = $1';
    $result = pg_query_params($dbconn,$q,array($idmov)) or die('Query failed, editing trailer' . pg_last_error());
    while ($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
        foreach($line as $indx => $val) {
            if($indx == 'unnest'){
                $genres[] = $val;
                
            }
        }
        $id = $line['movie_id'];
        $title = $line['title'];
        $plot = $line['plot'];
        $director = $line['director'];
        $year = $line['year_release'];
        $ratingimdb = $line['ratingimdb'];
        $duration = $line['duration'];
        $postimglink = $line['postimglink'];
        $coverimglink = $line['coverimglink'];
        $ytlink = $line['ytlink'];
    }
        ?>
        <form action="updateinfo.php" method="POST" name="addMovie" onSubmit="return validaForm();">
            <input type="text" class="form-control" name="title" placeholder="Film Title" value="<?php echo $title; ?>" /> <br>
            <input type="text" class="form-control" name="description" placeholder="Plot" value="<?php echo $plot; ?>" /> <br>
            <input type="text" class="form-control" name="director" placeholder="Director" value="<?php echo $director; ?>" /> <br>
            <input type="text" class="form-control" name="year" placeholder="Release Year" value="<?php echo $year; ?>" /> <br>
            <input type="text" class="form-control" name="imdb" placeholder="IMDB Rating" value="<?php echo $ratingimdb; ?>" /> <br>
            <input type="text" class="form-control" name="duration" placeholder="Duration" value="<?php echo $duration; ?>" /> <br>
            <input type="text" class="form-control" name="imglink" placeholder="Post Image Link" value="<?php echo $postimglink; ?>" /> <br>
            <input type="text" class="form-control" name="bigimglink" placeholder="Big Post Image Link | For Carousel" value="<?php echo $coverimglink; ?>" /> <br>
            <input type="text" class="form-control" name="ytlink" placeholder="YouTube Video Code" value="<?php echo $ytlink; ?>" /> <br>
            <p>Update genres</p>
            <div class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Action',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Action" <?php if(checkChecked('Action',$genres)) echo 'checked'; ?> > Action
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Adventure',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Adventure" <?php if(checkChecked('Adventure',$genres)) echo 'checked'; ?>> Adventure
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Comedy',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Comedy" <?php if(checkChecked('Comedy',$genres)) echo 'checked'; ?>> Comedy
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Crime',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Crime" <?php if(checkChecked('Crime',$genres)) echo 'checked'; ?>> Crime
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Romance',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Romance" <?php if(checkChecked('Romance',$genres)) echo 'checked'; ?>> Romance
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Sci-fi',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Sci-fi" <?php if(checkChecked('Sci-fi',$genres)) echo 'checked'; ?>> Sci-fi
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Drama',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Drama" <?php if(checkChecked('Drama',$genres)) echo 'checked'; ?>> Drama
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Fantasy',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Fantasy" <?php if(checkChecked('Fantasy',$genres)) echo 'checked'; ?>> Fantasy
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Animation',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Animation" <?php if(checkChecked('Animation',$genres)) echo 'checked'; ?>> Animation
                </label>
                <label class="btn btn-outline-info mb-md-1 <?php if(checkChecked('Horror',$genres)) echo 'active'; ?>">
                <input type="checkbox" name="gen[]" value="Horror" <?php if(checkChecked('Horror',$genres)) echo 'checked'; ?>> Horror
                </label>
                <input type="hidden" name="movie-id" value="<?php echo $id ?>">
            </div>
                <div class="modal-footer">
                <button type="submit" name="updatebutton" class="btn btn-info btn">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
<?php
}
else {
    header('Location: index.php');
}
?>