/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    $.getJSON( "http://yoquieroserwebmaster.hol.es/test/test.php", function( data ) {
        
        /* Para recojer informacion de php */
        /* Esto nos permite cambiar datos en nuestra aplicacion */
        
//        console.log(data.color);
//        localStorage.setItem("color", data.color);
//        localStorage.setItem("inicio", data.inicio);
    }).done(function() {
         setTimeout(function () {

                document.location.replace('app.html');
            }, 4000); // si el tiempo de ejecucion es menos e 4 segundos
    })

//    $.ajax({
//        url: "http://yoquieroserwebmaster.hol.es/test/test.php",
//        async: false,
//        contentType: "application/json",
//        dataType: 'jsonp',
//        success: function (result) {
//            $("#div1").html(result);
//
//            console.log(result)
//            localStorage.setItem("color", result);
//
//            setTimeout(function () {
//
//                document.location.replace('app.html')
//            }, 4000); // si el tiempo de ejecucion es menos e 4 segundos
//        }});




});


function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

//misphonegapconfigdavid.esy.es