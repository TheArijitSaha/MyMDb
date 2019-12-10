<!DOCTYPE html>

<?php
    require_once('classes/DataBase.php');
    require_once('classes/variables.php');
    require_once('classes/Nav.php');
    require_once('classes/SeriesClass.php');

    $filter_pre_select = 0;
    $filter_pre_string = '';

    if ( isset( $_GET['creator'] ) ) {
        $filter_pre_string = urldecode($_GET['creator']);
        $filter_pre_select = 2;
    } else if ( isset( $_GET['genre'] ) ) {
        $filter_pre_string = urldecode($_GET['genre']);
        $filter_pre_select = 4;
    } else if ( isset( $_GET['year'] ) ) {
        $filter_pre_string = $_GET['year'];
        $filter_pre_select = 3;
    }

    $stats = Series::getWatchedSeriesStats();

?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>MyMDb | Series</title>
        <link rel="icon" href="/MyMDb/MyMDbIcon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <?php echo Fonts::insertFonts(); ?>
        <link rel="stylesheet" href="static/css/master.css">
        <link rel="stylesheet" href="static/css/series_master.css">
    </head>
    <body>

        <!-- Navbar Begins-->
        <?php echo Nav::insertNavbar('Series'); ?>
        <!-- Navbar Ends-->

        <p></p>

        <div class="container">
            <div class="row">
                <div class="col-4 info">
                    <div class="stats">
                        <span class="watchBanner">WatchCounter:</span>
                        <div class="seriesStat">
                            <span class="statValue"><?php echo $stats['watchcount']; ?></span>
                            <span class="statPoint">Series</span>
                        </div>
                        <div class="timeStat">
                            <span class="statValue"><?php echo round($stats['totaltime']/60); ?></span>
                            <span class="statPoint">Hrs</span>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="filterOption">
                        <select id="seriesFilter" class="form-control">
                            <option<?php if ($filter_pre_select === 0) echo ' selected' ?>>No Filter</option>
                            <option<?php if ($filter_pre_select === 1) echo ' selected' ?>>Name</option>
                            <option<?php if ($filter_pre_select === 2) echo ' selected' ?>>Creator</option>
                            <option<?php if ($filter_pre_select === 3) echo ' selected' ?>>Year</option>
                            <option<?php if ($filter_pre_select === 4) echo ' selected' ?>>Genre</option>
                        </select>
                    </div>
                </div>
                <div id="filterActual" class="col-2">
                    <?php if ($filter_pre_select === 3) { ?>
                        <input class="form-control" type="number" id="filterString" value=<?php echo $filter_pre_string; ?> name="yearFilter" placeholder="Enter Year" autocomplete="off">
                    <?php } else if ($filter_pre_select === 1) { ?>
                        <input class="form-control" type="text" id="filterString" value="<?php echo $filter_pre_string; ?>" name="titleFilter" placeholder="Enter Name" autocomplete="off">
                    <?php } else if ($filter_pre_select === 2) { ?>
                        <input class="form-control" type="text" id="filterString" value="<?php echo $filter_pre_string; ?>" name="creatorFilter" placeholder="Enter Creator" autocomplete="off">
                    <?php } else if ($filter_pre_select === 4) { ?>
                        <input class="form-control" type="text" id="filterString" value="<?php echo $filter_pre_string; ?>" name="genreFilter" placeholder="Enter Genre" autocomplete="off">
                    <?php } ?>
                </div>
                <div class="col-2">
                    <div class="toggleSwitch Off btn btn-light ongoingFilter">
                        <input type="checkbox" name="ongoingfilter">
                        <div class="toggleGroup">
                            <label class="btn btn-danger toggleOn toggleLabel">Ongoing</label>
                            <label class="btn btn-success toggleOff toggleLabel">All</label>
                            <span class="btn btn-light toggleHandle"></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="/MyMDb/Series/Add" class="btn btn-outline-danger addButton">Add</a>
                </div>
            </div>
        </div>

        <div class="container seriesList">
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="static/js/series_script.js"></script>
    </body>
</html>
