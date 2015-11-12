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
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <style>
            .cuadrado{
                width: 50px;
                height: 50px;
                float: left;
            }
            .muro{
                background-color: #333;
            }
            .red{
                width: 50px;
                height: 50px;
                background-color: red;
            }
            .row{
                clear: left;
            }
            .verde{
                background-color: green;
            }
/*            .row:nth-child(1) .cuadrado:nth-child(1){
                background-color: green;
            }*/
            
        </style>
    </head>
    <body>
        <h1>Camino</h1>
        <p>elemento de alrededor</p>
        <div id="contenedor"></div>
        <?php
        // put your code here

        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript">

            var terreno = [
                [0, 0, 0, 0, 1, 0, 0],
                [0, 0, 0, 0, 1, 0, 0],
                [0, 0, 0, 0, 1, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 1, 0, 0, 0, 0],
                [0, 0, 1, 0, 0, 0, 0]
            ];
        </script>
        <script type="text/javascript">
            $.widget("custom.cuadricula", {
                options: {
                    position: '' ,
                    muro: false,
                },
                _create: function () {
                    this.element
                            .addClass("cuadrado")
                            .css("border", "1px solid black")
                            .html(this.options.position)
                            .attr("id", this.options.position );
                    if (this.options.muro) {
                        this.element
                            .addClass("muro")
                            .html("muro");
                    }

                    this.element.click(this._functionClick);
                },
                _functionClick: function(){
                        var esteCuadro = $(this);
                        var positionXY = esteCuadro.html().split('-');
                        $(".verde").removeClass("verde");
                        esteCuadro.addClass("verde");
                        esteCuadro._tour;
                    },
                _tour: function (){
                        var posicionArriba = "#"+(parseInt(positionXY[0])-1) +'-'+positionXY[1];
                        console.log(posicionArriba);
                        $(posicionArriba).css("background-color", "#f33");
                }
            });
            
            
//            var div = $('<div/>');
//            div.cuadricula({position: [i]+''+[j],muro:true});
//            $('#contenedor').append(div);

//            var div3 = $("<div />");
////            div3.addClass("red");
//            div3.html(".red");
//            div3.cuadricula();
//
//            console.log('div3');

//            $('#contenedor').append(div3);
            
            for (var i = 0; i < terreno.length; i++) {
//                console.log(terreno[i]);
                var row = $('<div/>');
                row.addClass('row');
                $('#contenedor').append(row);
                for (var j = 0; j < terreno[i].length; j++) {
//                    console.log(terreno[i][j]);
                    var div3 = $("<div />");
                    if(terreno[i][j] == 1){
                        div3.cuadricula({position: [i]+'-'+[j],muro:true});
                        row.append(div3);
                    }else{
                        div3.cuadricula({position: [i]+'-'+[j]});
                        row.append(div3);
                    }    
                }
                
            }
            
            var posicionVerde = [0,0]; 
            
            $("body").click(function(){
//                console.log(posicionVerde);
            });
            
            $(".cuadrado").css();
            
            
            var Ortogonal = 10;
            var Diagonal  = 14;
//            $(".row:nth-child("+posicionVerde[0]+1+") .cuadrado:nth-child("+posicionVerde[1]+1+")").css("background-color", "green");

            $("#3-5").css("background-color", "#f33");


        </script>
    </body>
</html>
