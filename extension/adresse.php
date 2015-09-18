<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    include_once 'Functions.php';
    $folderDownloads = 'downloads/';
    $fileDownloads = 'fileGeocode' . date('d_m_y_His') . '.csv';
    $dateTemp = date('dmyHis');
    $namePc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>GEOLOC</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <LINK REL="SHORTCUT ICON" HREF="favicon.ico" />

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>


        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script language="JavaScript">
            window.onbeforeunload = confirmExit;

            // Effacer de fichier temporaire si on sort de la page
            function confirmExit() {
                findme = <?php echo json_encode($namePc . $dateTemp); ?>;

                $.ajax({
                    url: "off.php/?findme=" + findme
                }).done(function () {

                });
                return "";
            }

        </script>
    </head>
    <body >
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">Geoloc</a>
                    <a class="navbar-brand" href="help.html">Aide</a>
                </div>
            </div>

        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Adresse CSV</h1>
            </div>
        </div>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                                <p id="TimeEstimee">Calcul de la durée estimée</p>
                <div id="progress-bar" class="progress">
                    <!--                    <div id="" class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">-->
                    <div id="progress-bar-bar" class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <div class="ProgressBarText"><span id="getprogress"></span>&nbsp;% completed</div>
                    </div>
                </div>
                <a id="btnDownload" class="btn btn-success" href=download.php?file=<?php echo $folderDownloads . $fileDownloads; ?>>Télécharger</a>

            </div>

            <hr>
            <p id="alu"></p>
            <footer>
                <p>&copy; <a href="http://www.articque.com/" target="_blank">Articque</a> 2015</p>
            </footer>
        </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script language="javascript">
            // Mis à jour de la barre de progression.
            function callprogress(vValor) {
                $("#getprogress").html(vValor.toFixed(2));
                $("#progress-bar-bar").css("width", vValor + "%");
            }
            $("#btnDownload").hide();
        </script>
    </body>
</html>
<?php
$timeDebut = date('H:i:s');
// supprimer des fichiers
cleanFiles();

// Vide les tampons de sortie du système
flush();
ob_flush();

$nameUpdateTemp = 'TMP.csv';
$updateTemp = 'uploads/' . $nameUpdateTemp;
$firstLine = '';
$nLine = 0;
$limiteSalto = 1000;
$limite = 1000;
$numberFiles = 0;
$contenido = '';
$entete = '';
if (isset($_POST ['entete'])) {
    $entete = $_POST ['entete'];
}
$enclist = array(
    'UTF-8', 'ASCII',
    'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5',
    'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10',
    'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16',
    'Windows-1251', 'Windows-1252', 'Windows-1254',
);

if (isset($_FILES['data']) || isset($_POST['url'])) {
    $serverUrl = $_POST['url'];

    if (testCSV($_FILES["data"]["type"])) {
        $tmp_name = $_FILES["data"]["tmp_name"];
        $name = 'TMP.csv';
        if (copy($tmp_name, $updateTemp)) {

            filePastToUtf8($updateTemp);

            if (mb_detect_encoding(file_get_contents($updateTemp), $enclist) == 'UTF-8') {

                //  Diviser le fichier dans 1000 lines
                $handle = fopen($updateTemp, 'r');
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    // Sauver la première ligne

                    $content = '';
                    if ($nLine == 0) {
                        for ($i = 0; $i < count($data); $i++) {
                            if ($i != (count($data) - 1)) {
                                $firstLine.= $data[$i] . ';';
                            } else {
                                $firstLine.= $data[$i];
                            }
                        }
                    } else {
                        $content = '';
                        for ($j = 0; $j < count($data); $j++) {
                            if ($j != (count($data) - 1)) {
                                $content .= $data[$j] . ';';
                            } else {
                                $content .=$data[$j];
                            }
                        }
                    }

                    $contenido .= $content . PHP_EOL;

                    //  Gréér le fichier de 1000 lines
                    if ($nLine++ == $limiteSalto) {
                        $limiteSalto += $limite;

                        if ($entete == 'true' && $numberFiles == 0) {
                            $contenido = $firstLine . PHP_EOL . $firstLine . $contenido;
                        } else {
                            $contenido = $firstLine . $contenido;
                        }

                        if (($file = fopen('uploads/temp/temp' . $numberFiles++ . $namePc . $dateTemp . '.csv', "c+")) == false) {
                            echo '<script>$("h1").html("Erreur impossible de créer des fichiers temporaires");'
                            . ' $("#progress-bar").hide(); </script>';
                            cleanFilesTemp($namePc . $dateTemp);
                            break;
                        };
                        fwrite($file, $contenido);
                        fclose($file);
                        $contenido = PHP_EOL;
                    }
                }


                if ($contenido != PHP_EOL || $contenido != '') {
                    if ($numberFiles > 0) {
                        $file = fopen('uploads/temp/temp' . $numberFiles++ . $namePc . $dateTemp . '.csv', "c+");
                        fwrite($file, $firstLine . $contenido);
                        fclose($file);
                    } else {
                        $file = fopen('uploads/temp/temp' . 0 . $namePc . $dateTemp . '.csv', "c+");

                        if ($entete == 'true' && $numberFiles == 0) {
                            fwrite($file, $firstLine . PHP_EOL . $firstLine . $contenido);
                        } else {
                            fwrite($file, $firstLine . $contenido);
                        }

                        fclose($file);
                        $numberFiles++;
                    }
                }

                // Assigne les données POST
                //  Utiliser le service Web
                $contenidodescarga = '';
                for ($i = 0; $i < $numberFiles; $i++) {
                    //  Mis à jour de la barre de progression.
                    $porcentaje = $i * 100 / $numberFiles;
                    echo "<script>callprogress(" . $porcentaje . ")</script>";
                    flush();
                    ob_flush();

                    $file_name_with_full_path = realpath('uploads/temp/temp' . $i . $namePc . $dateTemp . '.csv');
                    //$post = array('data' => '@' . $file_name_with_full_path);

                    if (isset($_POST['columns'])) {
                        $columns = $_POST['columns'];
                    } else {
                        $columns = array();
                    }

                    $post = array(
                        'data' => '@uploads/temp/temp' . $i . $namePc . $dateTemp . '.csv',
                        'columns' => $columns);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $serverUrl);
                    curl_setopt($ch, CURLOPT_POST, count($post));
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt_custom_postfields($ch, $post);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    //      Première ligne de résulta
                    $pos2 = stripos($result, PHP_EOL);

                    //      Construire fichier de réponse
                    $contenidodescarga.=substr($result, $pos2);
                    if ($i == 0) {
                        $firstLineResult = substr($result, 0, $pos2 - 1);
                        echo "<script>$('#TimeEstimee').html('Durée approximative du processus " . pastHours((strtotime('now') - strtotime($timeDebut)) * $numberFiles) . "')</script>";
                    }
                }
                // Créér fichier Geocodé 
                if (($file = fopen($folderDownloads . $fileDownloads, "c+")) != false) {
                    fwrite($file, $firstLineResult . $contenidodescarga);
                    fclose($file);
                } else {
                    echo '<script>$("h1").html("Erreur impossible de créer le fichier");'
                    . ' $("#progress-bar").hide(); </script>';
                }
                cleanFilesTemp($namePc . $dateTemp);
                echo "<script>callprogress(" . round(100) . ")</script>";
                echo '<script>$("#btnDownload").show()</script>';
            } else {
                echo '<script>$("h1").html("Erreur encodage de fichier incorrect <br/><small>' . mb_detect_encoding(file_get_contents($updateTemp), $enclist) . ' Le format correct est UTF-8</small> ");'
                . ' $("#progress-bar").hide(); </script>';
            }
        } else {
            echo '<script>$("h1").html("Erreur Impossible de copier le fichier");'
            . ' $("#progress-bar").hide(); </script>';
        }
    } else {
        echo '<script>$("h1").html("Erreur format de fichier incorrect");'
        . ' $("#progress-bar").hide(); </script>';
    }
} else {
    echo '<script>$("h1").html("Erreur dans la lecture de fichier");'
    . ' $("#progress-bar").hide(); </script>';
}
?> 
