<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>
            function callprogress(vValor.toFixed(2)) {
                $("#getprogress").html(vValor.toFixed(2));
                vValor = vValor.toFixed(2);
                console.log(vValor);
                $("#getProgressBarFill").html('<div class="ProgressBarFill" style="width: ' + vValor + '%;"></div>');
            }
        </script>

    </head>
    <body>
        
                    <h2>Retourne des coordonnées, grâce aux adresses.</h2>
                    <form id='formSearchCsv' action="http://10.37.5.11:8000/search/csv/" method="post" enctype="multipart/form-data">
<!--                        <input hidden="" type="text" name="url" value="http://10.37.5.11:8000/search/csv/"/> -->
                        <p id="contentColumnsSlips">Glisser un fichier ici, ou choisir un chemin de destination’</p>
                        <input id ='fileSearch' class=" searchFile" type="file" name="data" 
                               onchange="handleFileSelect(event, '#contentColumns')" /> 
                        <p id='contentColumns'></p>
                        <input id="btnPHP" type="submit" class="btn btn-default" value="Rechercher les coordonnées" title="Rechercher" />
                    </form>
        
        
        
        <?php /*
//            $file = fopen('uploads/TMP.csv'  ,'r');
//            $linea = fgets($file);
//            echo $linea;
//            echo '<br/>';
//            $str = 'áéóú'; // ISO-8859-1
//            echo mb_detect_encoding($str, 'UTF-8');
//            $fp = fopen('uploads/TMP.csv', 'r');
//            $fp = fopen('uploads/TMP2.csv', 'r');
//            $fp = fopen('uploads/result.csv', 'r');
//            $fp = fopen('uploads/TMP1.txt', 'r');
//            while(!feof($fp)) {
        $linea = file_get_contents('uploads/TMP2.csv') . '<br />';
//            }
//            fclose($fp);

        echo $linea . '<br />';

        echo mb_detect_encoding($linea, 'UTF-8');
        echo '<br/>';
        echo mb_detect_encoding($linea, 'auto');
        echo '<br/>';



        $text = "Este es el símbolo dél euro: '€'.";

        echo 'Original : ' . $text;
        echo'<br/>';
        echo 'TRANSLIT : ' . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $text) . '<br/>';
        echo 'IGNORE   : ' . iconv("UTF-8", "ISO-8859-1//IGNORE", $text) . '<br/>';
//echo 'Plain    : '. iconv("UTF-8", "ISO-8859-1", $text). '<br/>';

        echo '<hr/>'; */
        ?>
        <div id="progress-bar" class="progress">
            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                <div class="ProgressBarText"><span id="getprogress"></span>&nbsp;% completed</div>
            </div>
        </div>

        <style>
            .thumb {
                height: 75px;
                border: 1px solid #000;
                margin: 10px 5px 0 0;
            }




input#file {
  display: inline-block;
  width: 100%;
  padding: 120px 0 0 0;
  height: 100px;
  overflow: hidden;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background: url('http://archisnapper.com/cloud.png') center center no-repeat #e4e4e4;
  border-radius: 20px;
  background-size: 150px 100px;
}


        </style>

<!--        <input type="file" id="files" name="files[]" multiple />
        <output id="list"></output>-->

        <script>
//            function handleFileSelect(evt) {
//                var files = evt.target.files; // FileList object
//
//                // Loop through the FileList and render image files as thumbnails.
//                for (var i = 0, f; f = files[i]; i++) {
//
//                    // Only process image files.
//                    //      if (!f.type.match('image.*')) {
//                    //        continue;
//                    //      }
//
//                    var reader = new FileReader();
//
//                    // Closure to capture the file information.
//                    reader.onload = (function (theFile) {
//                        return function (e) {
//                            // Render thumbnail.
//                            res = e.target.result.split("\n")[0]
//                            arr = res.split(";");
//                            columns = '';
//                            for (i = 0; i < arr.length; i++) {
//                                columns += '<input type="checkbox" name="columns[]" value="' + arr[i] + '">' + arr[i] + ' ';
//                            }
//                            var span = document.createElement('span');
//                            span.innerHTML = ['<p>', columns, '</p>'].join('');
//                            document.getElementById('list').insertBefore(span, null);
//                        };
//                    })(f);
//
//                    // Read in the image file as a data URL.
//                    reader.readAsText(f);
//                }
//            }
//
//            document.getElementById('files').addEventListener('change', handleFileSelect, false);
        </script>
<form>
  <input id="file" type="file" />
</form>
    </body>
</html>

<?php
echo $porcentaje = 1 * 100 / 1985;
echo "<script>callprogress(" . $porcentaje . ")"
//                . "; console.log('".$porcentaje."')"
 . "</script>";
?>
<!--arr = res.split(";");-->