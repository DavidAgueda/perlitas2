<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$name = 'David Agueda Roblas';
$name = '-';
$projectos_Estrellas = array(
    array('Projecto1', 'Descripcion breve los proyectos'),
    array('Projecto2', 'Descripcion breve los proyectos'),
    array('Projecto3', 'Descripcion breve los proyectos'),
    array('Projecto4', 'Descripcion breve los proyectos')
);

$Tecnologias = array(
    array('Html', 'Imagen.png', 'Aqui los proyectos que usan esta tecnologia', 'enlace'),
    array('Js', 'Imagen.png', 'Aqui los proyectos que usan esta tecnologia', 'enlace'),
    array('Symfony', 'Imagen.png', 'Aqui los proyectos que usan esta tecnologia', 'enlace'),
    array('Titulo', 'Imagen.png', 'Texto', 'enlace')
);

//var_dump(count($projectos_Estrellas));
//
//
//for ($index = 0; $index < count($projectos_Estrellas); $index++) {
//    print_r($projectos_Estrellas[$index]);
//}
?>
<?php ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $name ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h1><?php echo $name; ?></h1>
            <hr>
            <br>

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < count($projectos_Estrellas); $i++) {
                        if ($i == 0) {
                            echo'<li data-target="#carousel-example-generic" data-slide-to="' . $i . '" class="active"></li>';
                        } else {
                            echo'<li data-target="#carousel-example-generic" data-slide-to="' . $i . '" class=""></li>';
                        }
                    }
                    ?>

                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php
                    for ($i = 0; $i < count($projectos_Estrellas); $i++) {
                        if ($i == 0) {
                            ?>
                            <div class="item active">
                                <div class="centre slideTextSize">
                                    <h2><?php echo $projectos_Estrellas[$i][0]; ?></h2>
                                    <p><?php echo $projectos_Estrellas[$i][1]; ?></p>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="item">
                                <div class="centre slideTextSize">
                                    <h2><?php echo $projectos_Estrellas[$i][0]; ?></h2>
                                    <p><?php echo $projectos_Estrellas[$i][1]; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <hr>
            <nav class="row">

                    <ol class="centre">
                        <li>Home</li>
                        <li>CV</li>
                        <li>Tecnos</li>
                        <li>Contacto</li>
                    </ol>
            </nav> 
            <hr>
            <div class="row">
                <div class="col-md-2">.col-md-2</div>
                <div class="col-md-8 col-xs-12">.col-md-8 col-xs-12
                    <?php
                    echo '<div class="row">';
                    for ($i = 1; $i < count($Tecnologias) + 1; $i++) {
                        echo '<div class="col-md-4 tecnoInfo"> '
                        . '<img class="tecnoImagen centre" src="' . $Tecnologias[$i - 1][1] . '" alt=""> '
                        . '<h3>' . $Tecnologias[$i - 1][0] . '</h3>'
                        . '<p>' . $Tecnologias[$i - 1][2] . '</p>'
                        . '<a href="#">' . $Tecnologias[$i - 1][3] . '</a>'
                        . '</div>';
                        if (($i % 3) == 0) {
                            echo '</div><div class="row">';
                        }
                    }
                    echo '</div>';
                    ?>
                </div>
                <div class="col-md-2">.col-md-2</div>
            </div>
        </div>
        <?php
// put your code here
        ?>
    </body>
</html>
