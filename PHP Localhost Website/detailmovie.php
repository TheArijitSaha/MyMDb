<!DOCTYPE html>

<?php
    require_once('classes/DataBase.php');
    require_once('classes/variables.php');
    require_once('classes/MovieClass.php');
    require_once('classes/Nav.php');

    $current_movie = new Movie($_GET['id']);
    if ( !$current_movie->isReal() ) {
        header("Location: ".NetworkVariables::$home_path."Error");
    }

    function directorString($directors) {
        $director_array = explode(', ',$directors);
        $f = "";
        for ($i=0; $i < count($director_array)-1 ; $i++) {
            $f = $f . '<a href="' . NetworkVariables::$home_path . 'Movies/Director/' . urlencode( $director_array[$i] ) . '">' . $director_array[$i] . '</a>, ';
        }
        $f = $f . '<a href="' . NetworkVariables::$home_path . 'Movies/Director/' . urlencode( $director_array[count($director_array)-1] ) . '">' . $director_array[count($director_array)-1] . '</a>';
        return $f;
    }

    function genreString($genres) {
        $genre_array = explode(', ',$genres);
        $f = "";
        for ($i=0; $i < count($genre_array)-1 ; $i++) {
            $f = $f . '<a href="'.NetworkVariables::$home_path.'Movies/Genre/' . urlencode( $genre_array[$i] ) . '">' . $genre_array[$i] . '</a>, ';
        }
        $f = $f . '<a href="'.NetworkVariables::$home_path.'Movies/Genre/' . urlencode( $genre_array[count($genre_array)-1] ) . '">' . $genre_array[count($genre_array)-1] . '</a>';
        return $f;
    }
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>MyMDb | Movies</title>
        <link rel="icon" href="<?php echo NetworkVariables::$home_path; ?>MyMDbIcon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <?php echo Fonts::insertFonts(); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo NetworkVariables::$home_path; ?>static/css/master.css">
        <link rel="stylesheet" href="<?php echo NetworkVariables::$home_path; ?>static/css/detailmovie_master.css">
    </head>
    <body>

        <!-- Navbar Begins-->
        <?php echo Nav::insertNavbar('Movies'); ?>
        <!-- Navbar Ends-->

        <p></p>

        <div class="container movieCard">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 namePlate">
                        <span class="Title"><?php echo $current_movie->getTitle(); ?></span>
                        <span class="Subtitle"><?php echo $current_movie->getSubtitle(); ?></span>
                    </div>
                    <div class="col-lg">
                        <i class="fa fa-trash deleteBtn" aria-hidden="true"></i>
                        <a href="<?php echo $current_movie->getId().'/edit' ?>"><i class="fa fa-edit editBtn"></i></a>
                        <?php if ($current_movie->watched()) { ?>
                            <span class="watchedText watchDisp">Seen</span>
                        <?php } else { ?>
                            <span class="unwatchedText watchDisp">Unseen</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">Year of Release </p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><a href="<?php echo NetworkVariables::$home_path.'Movies/Year/'.((int)$current_movie->getReleaseYear()); ?>"><?php echo $current_movie->getReleaseYear(); ?></a></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">Directed By </p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><?php echo directorString($current_movie->getDirector()); ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">Runtime </p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><?php echo $current_movie->getRuntime()." Minutes"; ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">Starring </p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><?php echo $current_movie->getCast(); ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">Genre </p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><?php echo genreString($current_movie->getGenre()); ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">IMDb</p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><?php echo $current_movie->getIMDbRating(); ?> <a class="imdbLink" href="<?php echo $current_movie->getIMDbLink(); ?>" target="_blank">(Link)</a></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="movieInfo">Tomatometer</p>
                                </div>
                                <div class="col-lg">
                                    <p class="movieValue"><?php echo $current_movie->getRottenTomatoesRating(); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 flexCenterRow">
                        <div class="posterHolder flexCenterCol">
                            <div class="flexCenterRow noImage">
                                <div>Poster</div>
                            </div>
                            <div class="flexCenterRow noImage">
                                <div>Unavailable</div>
                            </div>
                            <img class="posterImage" src="<?php echo $current_movie->getPoster(); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="number" id="currentID" value="<?php echo $current_movie->getId(); ?>" hidden>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="static/js/detailmovie_script.js"></script>
    </body>
</html>
