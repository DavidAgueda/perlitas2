<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    session_start();
    include './class/user.php';
    include './class/connection.php';

    if ($_SESSION['viewLogin'] == null) {
        header('Location: index.html');
    }else{
        
    }

    if (isset($_POST['close'])) {
        $_SESSION['viewLogin'] = null;
        header('Location: index.html');
    }
    
    require_once './class/connection.php';
    require_once './class/log.php';
    require_once './class/tableau.php';
    
    $con = new connection();
    $con->connect();
//    $con->test();
    
    $tableu = new tableau($con->gbd);
    
    if(!isset($_GET['pagina'])){
            $start  = 0;
            $pagina = 1;
    }else{

        $pagina = $_GET['pagina'];
        $start = ($pagina-1)* 10;
        if($_GET['pagina'] == 0 || $_GET['pagina'] == ''){
            $start  = 0;
            $pagina = 1;
        }
    }
    $table  = $tableu->printTableau($start);
    $pageBefore = $pagina-1;
    $pageNext   = $pagina+1;
    $before = '<a href="logsList.php?pagina=' .$pageBefore.  '" >&LT;</a>';
    $next   = '<a href="logsList.php?pagina=' .$pageNext.    '" >&GT;</a>';
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Logs list</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="SHORTCUT ICON" href="favicon.ico" />

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            h1{
                font-size: 3.3em !important;
            }
            ul{
                font-size: 20px;
                padding-left: 7%;
            }

            .sobrepuesto{
                position: fixed;
                top: 0px;
                left: 0px;
                z-index: 3;
                height: 100%;
                width: 100%;
                background-color: rgba(50,50,50,0.8);

            }
            .login{
                position: relative;
                top: 40%;
                left: 40%;
                background-color: #ffffff;
                height: 150px;
                width: 250px;
                /*                padding:10px;*/
                border: solid 3px #ccc;
                box-shadow: 10px 20px 10px #000;
            }
            .login button{
                float: right;
                margin: 0px;
                background-color: #ff3333;
                border: none;
                color:#000;

            }
            .login form{
                width: 80%;
                margin: 0px auto;
                clear: both;
            }

            .login form input{
                margin: 5px;
            }
            nav form{
                float: right;
            }
            nav input{
                border: none;
                border-right: solid 1px black;
                border-left: solid 1px black;
                background-color: initial;
                margin-left: 0px !important;
                padding: 10px !important;
            }
            .row p a{
                font-size: 1.2em;
                font-weight: bold;
                text-decoration:none;
                padding: 5px;
                padding-left: 10px;
                padding-right: 10px;
                border: 1px solid #ccc; 
                width: 20px;
                height: 20px;
                
            }


        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">Geoloc</a>
                    <a class="navbar-brand" href="help.html">Aide</a>
                    <a class="navbar-brand" href="">Admin<hr></a>

                    <form method="post">
                        <input class="navbar-brand" type="submit" name="close" value="Close Session">
                    </form>
                </div>
            </div>

        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Logs list</h1>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
            <?php
            $totalPage = ceil($tableu->dbRow / $tableu->sizePage);
            if ($pagina == $totalPage){
                $next='';
            }
            if ($pagina == 1){
                $before='';
            }
            echo '<p>'.$before.' Page '.$pagina.' of '.$totalPage.' '.$next.' </p>';
            ?>
            </div>
            <div class="row">
            <?php 
                print $table
            ?>
            </div>

            <hr>
            <p id="alu"></p>
            <footer>
                <p>&copy; <a href="http://www.articque.com/" target="_blank">Articque</a> 2015</p>
            </footer>
        </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <!--        <script src="js/DropArea.js"></script>
                <script src="js/DropArea2.js"></script>-->    


    </body>
</html>
