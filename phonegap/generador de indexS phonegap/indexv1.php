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
    </head>
    <body>
        <h1>Generador de pagina index para phonegap</h1>
        <form method="GET">
            <lavel for="titre">Titulo</lavel> <input type="text" name="titre"></br>
            <lavel for="H1P1">H1P1</lavel> <input type="text" name="H1P1"></br>
            <lavel for="CBH1P1">Color H1P1</lavel> <input type="color" name="CBH1P1" value="#ffffff"></br>
            <lavel for="H1P1">H1P2</lavel> <input type="text" name="H1P2"></br>
            <button type="submit" value="enviar">Enviar </button>
        </form>
        <?php
        $Titulo = "";
        $H1P1 = "";
        $CBH1P1 = "";
        $H1P2 = "";

        if (isset($_GET['titre'])) {
            $Titulo = $_GET['titre'];
            //echo $_GET['titre'];
        }
        if (isset($_GET['H1P1'])) {
            $H1P1 = $_GET['H1P1'];
            //echo $_GET['titre'];
        }
        if (isset($_GET['CBH1P1'])) {
            $CBH1P1 = $_GET['CBH1P1'];
            //echo $_GET['titre'];
        }
        if (isset($_GET['H1P2'])) {
            $H1P2 = $_GET['H1P2'];
            //echo $_GET['titre'];
        }
        
        $index = '
<!DOCTYPE html>
<html>
    <head>
        <!--
        Customize this policy to fit your own app\'s needs. For more guidance, see:
            https://github.com/apache/cordova-plugin-whitelist/blob/master/README.md#content-security-policy
        Some notes:
            * gap: is required only on iOS (when using UIWebView) and is needed for JS->native communication
            * https://ssl.gstatic.com is required only on Android and is needed for TalkBack to function properly
            * Disables use of inline scripts in order to mitigate risk of XSS vulnerabilities. To change this:
                * Enable inline JS: add \'unsafe-inline\' to default-src
        -->
        <meta http-equiv="Content-Security-Policy" content="default-src \'self\' data: gap: https://ssl.gstatic.com \'unsafe-eval\'; style-src \'self\' \'unsafe-inline\'; media-src *">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="js/jquery-2.2.0.min.js" type="text/javascript"></script>
        <link href="css/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
        
        <style>
            div[data-role="header"]{
                background-color: ' . $CBH1P1 . ' !important; 
            }
        </style>

        <title>' . $Titulo . '</title>
    </head>
    <body>

        <div data-role="page" id="pageone">
        

            <div data-role="panel" id="myPanel" data-position="left"> 
                <h2>Panel Header</h2>
                <a href="#pagetwo" data-transition="slidedown">Flip to Page Two</a>
                <p>You can close the panel by clicking outside the panel, pressing the Esc key, by swiping, or by clicking the button below:</p>
                <a href="#pageone" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Close panel</a>
            </div> 



            <div data-role="header">
                <a href="#myPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Open Panel</a>
                <h1>' . $H1P1 . '</h1>
            </div>

            <div data-role="main" class="ui-content">
                <p>Click on the link to see the flip effect.</p>
                <a href="#pagetwo" data-transition="slidedown">Flip to Page Two</a>
            </div>

            <div data-role="footer">
                <h1>Footer Text</h1>
            </div>
        </div> 

        <div data-role="page" id="pagetwo">
            <div data-role="header">
                <h1>' . $H1P2 . '</h1>
            </div>

             <div data-role="main" class="ui-content">
                <p>Click on the link to go back. <b>Note</b>: fade is default.</p>
                <a href="#pageone" data-transition="slidedown">Go back to Page One</a>
            </div>

            <div data-role="footer">
                <h1>Footer Text</h1>
            </div>
        </div> 
    </body>
</html>';
        
fileIndex($index);
                
                
function fileIndex($data) {
    if (($file = fopen('./indexs/index.html', "w+")) != false) {
        fwrite($file, $data);
        fclose($file);
    }
}
        ?>
        <pre>
<?php echo htmlentities($index); ?>
        </pre>
    </body>
</html>
