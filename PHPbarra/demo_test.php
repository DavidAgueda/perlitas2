
<html><head>
<script language="javascript">
//Creo una función que imprimira en la hoja el valor del porcentanje asi como el relleno de la barra de progreso
function callprogress(vValor){
 document.getElementById("getprogress").innerHTML = vValor;
 document.getElementById("getProgressBarFill").innerHTML = '<div class="ProgressBarFill" style="width: '+vValor+'%;"></div>';
}
</script>
<style type="text/css">
/* Ahora creo el estilo que hara que aparesca el porcentanje y relleno del mismoo*/
/*      .ProgressBar     { width: 16em; border: 1px solid black; background: #eef; height: 1.25em; display: block; }
      .ProgressBarText { position: absolute; font-size: 1em; width: 16em; text-align: center; font-weight: normal; }
      .ProgressBarFill { height: 100%; background: #aae; display: block; overflow: visible; }*/
    </style>
</head>
<body>
<!-- Ahora creo la barra de progreso con etiquetas DIV -->

 <div class="ProgressBar">
      <div class="ProgressBarText"><span id="getprogress"></span>&nbsp;% completado</div>
      <div id="getProgressBarFill"></div>
    </div>


<?php
 /*Ahora procedo a crear la situación de importacion de registros, para este caso utilizaré el bucle FOR, también puede funcionar con WHILE. Recuerden sólo en este caso estaré utilizando for ya que es a modo de ejemplo y no estoy trabajando con base de datos*/
$ValorTotal=25; //Valor total de registros


for($i=1;$i<=$ValorTotal;$i++){ //le digo que si es igual al total detengo el bucle
 sleep(1); //descanso 1 minuto para mostrar de forma pausada el proceso
 $porcentaje = $i * 100 / $ValorTotal; //saco mi valor en porcentaje
 echo "<script>callprogress(".round($porcentaje).")</script>"; //llamo a la función JS(JavaScript) para actualizar el progreso
 flush(); //con esta funcion hago que se muestre el resultado de inmediato y no espere a terminar todo el bucle con los 25 registros para recien mostrar el resultado
 ob_flush();
}
?> 