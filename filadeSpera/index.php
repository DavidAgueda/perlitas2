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
        <script src="../js/libs/jquery/jquery.js"></script>
    </head>
    <body>
        <form  method="post" enctype="multipart/form-data">
            <input id='data' class="btn btn-default" type="text" name="data" /> </br>
            <input id="btnPHP" type="button" class="btn btn-default" value="Enviar" title="Rechercher" />
        </form>
        <div id="destino"></div>
        <?php
        // put your code here
        ?>
        <script>
            $('#btnPHP').click(function () {


                $.post("control.php", {nombre: $('input[name="data"]').val(), edad: 45}, function (data) {
                    $('#destino').html(data);
                    //alert(data);
                });
            });


        </script>
    </body>
</html>
