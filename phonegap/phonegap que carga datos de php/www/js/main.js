/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    if (typeof (Storage) !== "undefined") {
        if (localStorage.color == "undefined") {
            localStorage.setItem("color", "red");
        }
        if (localStorage.inicio == "undefined") {
            localStorage.setItem("inicio", "el mio");
        }
    } else {
        console.log('no storage');
    }
    
    $('h1').html(localStorage.inicio)
    
    $.getJSON( "http://yoquieroserwebmaster.hol.es/test/test.php", function( data ) {
        
        console.log(data.color);
        localStorage.setItem("color", data.color);
        localStorage.setItem("inicio", data.inicio);
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


    console.log(localStorage.color);


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