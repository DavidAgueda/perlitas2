
$().ready(function(){

    // cambiar estos datos por valores por defecto
    if (typeof (Storage) !== "undefined") {
        if (localStorage.color == "undefined") {
            localStorage.setItem("color", "#FFF");
        }
        if (localStorage.inicio == "undefined") {
            localStorage.setItem("inicio", "el mio");
        }
    } else {
        console.log("no storage");
    }
    
    localStorage.colorload = "#ff0000";
    localStorage.H1tile = "formation";

    $("body").css("background-color",localStorage.colorload);
    $("h1").html(localStorage.H1tile);
});

    