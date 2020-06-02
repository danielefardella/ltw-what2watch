import { loadState, saveState} from ''./localStorage';
import { createStore } from 'redux';

const persistedState = loadState();
const store = createStore(persistedState);
store.subscribe(() => {
  saveState({
    store.getState()
  });
});

<?php require 'dbconnect.php'; // Connection to DB 
session_start(); // creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <title>WHAT2WATCH - Explore movies you've never seen</title>
      <meta name="description" content="Are you bored and would like to watch some movie but do not know which one? This site is for you! every refresh explore new movies base on your genre.">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"  type='text/css'>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css"> 
    </head>
<body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navbar-custom">
      <a class="navbar-brand" href="index.php">WHAT<span class="chnageit">2</span>WATCH <i class="fas fa-video sitetextgen"></i> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <span style="color:#55595c;" class="nav-link"> 》Every refresh new movies </span>
      </li>
      </ul>
      <?php 
      if (isset($_SESSION['sessionUser'])){
        echo '<span class="loggedin white">Hi, <span class="sitetextgen"><strong>' .$_SESSION['sessionUser'] .'</strong></span></span>';
        echo '<a id="button_login" class="btn btn-info my-2 mr-1" href="admin.php">Admin Panel</a> ';
        echo '<a id="button_login" class="btn btn-info my-2" href="logout.php">Logout</a>';
      }
      else {
        echo '<a id="button_login" class="btn btn-info my-2" href="login.php">Admin Login</a>';
      }
      ?>
      </div>
      </nav>
    </header>
    <?php
    // Function to get information of slider
    function bannerinfo() {
      //$querybanner = 'SELECT * FROM banner ORDER BY id ASC';
      $querybanner = 'SELECT * FROM movies ORDER BY year_release DESC, random() LIMIT 3;';
      $result = pg_query($querybanner) or die ('Banner Query failed: ' .pg_last_error());
      return $result;
    }
    // Function to indicator of slider
    function indicators() {
      $result = bannerinfo(); //Gets the info from the previous function bannerinfo()
      $show = '';
      $countbanner = 0;
      while ($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
        if ($countbanner == 0) {
          $show .= '<li data-target="#carouselExampleCaptions" data-slide-to="'.$countbanner.'" class="active"></li>';
        }
        else {
          $show .= '<li data-target="#carouselExampleCaptions" data-slide-to="'.$countbanner.'"></li>';
        }
        $countbanner += 1;
      }
      return $show;   
    }
    // Function to check if exists any movie in the slider section
    function emptyCheck($tableSource) {
      $query = 'SELECT * FROM '.$tableSource.'';
      $result = pg_query($query) or die ('Query check is failed ' . pg_last_error());
      $line = pg_num_rows($result);
      return $line;
    }

    // Function ,echo the movies in order of last movies, upcoming movies.
    function items() {
      $result = bannerinfo();
      $show = '';
      $countbanner = 0;
      while ($line = pg_fetch_array($result,null,PGSQL_ASSOC)) { //Se a noi ci interessa soltanto i primi 10 righe scriviamo invece di null 10,PGSQL_ASSOC vuiol dire il nosto array e associativo
        if ($countbanner == 0) {
          $show .= '<div class="carousel-item active">';
        }
        else {
          $show .= '<div class="carousel-item">';
        }
        $show .= '<a href="" data-id="'.$line['movie_id'].'" data-title="'.$line['title'].' ('.$line['year_release'].')" class="movieopen"><img src="'.$line['coverimglink'].'" class="d-block w-100" alt="'.$line['plot'].'"></a>
                  <div class="carousel-caption d-none d-md-block" >
                    <div style="background-color:rgba(0, 0, 0, 0.5); padding:5px; border-radius: 25px;">
                    <a href="" data-id="'.$line['movie_id'].'" data-title="'.$line['title'].' ('.$line['year_release'].')" class="movieopen"><h5>'.$line['title'].'</h5></a>
                      <p>'.$line['plot'].'</p>
                    </div>
                  </div>
                </div>';
        $countbanner += 1;
      }
      return $show;
    }
    ?>
    <!--wrapcar Start-->
    <div id="wrapcar">
    <?php if (emptyCheck("movies") == 0) { ?>
      <h2>No movies are available</h2>';
    <?php }
    else { ?>
    <!--Carousel Start-->
    <div id="carus" class="clearfix"> <!-- or inline-flex, the child elements will be displayed side-by-side, even if they are not floated. -->
    <div class="textside">
    <h1>THE LATEST HOTTEST MOVIES, <br>
    COMING OUT SOON!</h1>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php echo indicators() ?>
      </ol>
        <div class="carousel-inner">
          <?php echo items() ?>
        </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!--Carousel END-->
    </div>
    </div>
    <!--wrapcar END-->
    <?php } 
    ?>
    <!-- Start of Wrap -->
    <div class="wrap sitetextgen">
    <?php
    if(emptyCheck('movies') == 0) {
      echo "<h2>No trailers found</h2>";
    }
    else { ?>
    <div class="clearfix" style="padding-bottom:13px;">
    <div style="float:left;">
    <h2><i class="fas fa-video" style="color:#21c7e1;"></i> Looking for a movie</h2>
    </div>
    <div class="form-group" style="float:right;">
    <form>
        <select class="form-control" id="exampleFormControlSelect1" style="color:#17a2b8;background:#161717; font-size:18px; border-color:#222528;">
        <option value="selectgenre" disabled selected> Select Genre </option>
        <option value="All genres">All Genres</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Comedy">Comedy</option>
        <option value="Crime">Crime</option>
        <option value="Romance">Romance</option>
        <option value="Drama">Drama</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Animation">Animation</option>
        <option value="Horror">Horror</option>
        <option value="Sci-fi">Sci-fi</option>
        </select>
    </form>
    </div>
    </div>
    <br>
    <!--5 Cards in a row-->
    <div class="row row-cols-1 row-cols-md-5" style="text-align:center;">
    <?php 
    $querymovies = 'SELECT * FROM movies order by random() LIMIT 15';
    $q = pg_query($querymovies) or die('Query failed ' . preg_last_error());
    while ($line = pg_fetch_array($q,null,PGSQL_ASSOC)) {
      
      ?>
    <!-- Card Repeat-->
    <div class="col mb-4">
      <div class="card" style="background:#32363a;">
        <a href="" data-id="<?php echo $line['movie_id']; ?>" data-title="<?php echo $line['title'] . ' ('.$line['year_release'] . ')'; ?>" class="movieopen"><img src="<?php echo $line['postimglink']; ?>" class="card-img-top" alt="<?php echo $line['title']; ?>" style="max-height:300px;"></a>
        <div class="card-body" style="padding:10px;">
        <a href="" data-id="<?php echo $line['movie_id']; ?>" data-title="<?php echo $line['title'] . ' ('.$line['year_release'] . ')'; ?>" class="movieopen"><h5 class="card-title"><?php echo $line['title']; ?></h5></a>
        </div>
      </div>
    </div>
    <!-- Card End repeat-->

  
    <?php }}//End while loop (Movies in rows) and Else?>
    </div>
    <!--Closing DIV 5 in a row-->
    </div></div>
    <!-- End of Wrap -->

      <!-- Modal -->
      <div class="modal fade" id="movieModal">
      <div class="modal-dialog modal-lg modal-dialog-centered"> <!--Added style with with because it doesn't work together with scrollable-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
        </div>
      </div>
    <!-- End Modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/alljs.js"></script>
  </body>
</html>