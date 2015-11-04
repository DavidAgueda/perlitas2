$('document').ready(function () {
    $('#progress-bar').hide();
    $('#progress-bar2').hide();
});
$('#btnPHP').click(function () {
    $('#progress-bar').show();
})
$('#btnPHP2').click(function () {
    $('#progress-bar2').show();
})

// Fonction pour effectuer un recherche avec l'adresse
$("#rcParAdresse").click(function () {
    var adresse = $("#adresse");
    var result = $.ajax({
        type: "GET",
        url: "http://10.37.5.11:8000/search/?q="
                + adresse.val() + "&autocomplete=0&limit=1",
        async: false}).fail(function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 0) {
            alert('Not connect: Verify Network.');
        } else if (jqXHR.status == 404) {
            alert('Requested page not found [404]');
        } else if (jqXHR.status == 500) {
            alert('Internal Server Error [500].');
        } else if (textStatus === 'parsererror') {
            alert('Requested JSON parse failed.');
        } else if (textStatus === 'timeout') {
            alert('Time out error.');
        } else if (textStatus === 'abort') {
            alert('Ajax request aborted.');
        } else {
            alert('Uncaught Error: ' + jqXHR.responseText);
        }
    });

    result = $.parseJSON(result.responseText);

    if (result.features.length > 0) {
        var url = "http://www.openstreetmap.org/export/embed.html?bbox="
                + result.features[0].geometry.coordinates[0] + "%2C"
                + result.features[0].geometry.coordinates[1] + "%2C"
                + result.features[0].geometry.coordinates[0] + "%2C"
                + result.features[0].geometry.coordinates[1] + "&amp;layer=mapnik";

        var iframe = '<iframe width="425" height="350" frameborder="0"\n\
            scrolling="no" marginheight="0" marginwidth="0" src="' + url
                + '" style="border: 1px solid black"></iframe><br/><small>\n\
            <a href="http://www.openstreetmap.org/#map=19/47.25899/-2.34096">\n\
            Afficher un plan</a></small></br>';

        text = "lon : " + result.features[0].geometry.coordinates[0] + " <br> lat : "
                + result.features[0].geometry.coordinates[1] + "<br>"
                + "Label : " + result.features[0].properties.label + "</br>" + iframe
                + '<input id="downloadFile" class="btn btn-default" type="button"'
                + ' title="Télécharger" value="Télécharger GeoCodeJSON">';
        $("#div1").html(text);
        downloadGeoCodeJSON(result);
    } else {
        $("#div1").html("<h3>Pas de données</h3> Essayez une autre requête .");
    }
});

// Fonction pour effectuer un recherche avec la longitude et la latitude
$("#rcParLonLat").click(function () {
    var lon = $("#lon");
    var lat = $("#lat");

    if (lon.val() != '' && lat.val() != '') {
        var controlLon = true;
        var controlLat = true;
        if (isNaN(lon.val())) {
            alert("lon n'est pas un numéro");
            controlLon = false;
        }
        if (isNaN(lat.val())) {
            alert("lat n'est pas un numéro");
            controlLat = false;
        }

        if (controlLon && controlLat) {
            var result = $.ajax({type: "GET", url: "http://10.37.5.11:8000/reverse/?lon="
                        + lon.val() + "&lat=" + lat.val(), async: false})
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 0) {
                            alert('Not connect: Verify Network.');
                        } else if (jqXHR.status == 404) {
                            alert('Requested page not found [404]');
                        } else if (jqXHR.status == 500) {
                            alert('Internal Server Error [500].');
                        } else if (textStatus === 'parsererror') {
                            alert('Requested JSON parse failed.');
                        } else if (textStatus === 'timeout') {
                            alert('Time out error.');
                        } else if (textStatus === 'abort') {
                            alert('Ajax request aborted.');
                        } else {
                            alert('Uncaught Error: ' + jqXHR.responseText);
                        }
                    });

            result = $.parseJSON(result.responseText);

            if (result.features.length > 0) {
                text = "Label : " + result.features[0].properties.label + "</br>"
                        + '<input id="downloadFile" class="btn btn-default" type="button"'
                        + ' title="Télécharger" value="Télécharger GeoCodeJSON">';
                $("#div1").html(text);
                downloadGeoCodeJSON(result);
            } else {
                $("#div1").html("<h3>Pas de données</h3> Essayez une autre requête .");
            }
        }
    } else {
        alert("Vous devez saisir les deux champs avec des values numériques SVP.");
    }

});


// Fonction qui permet de lire la première ligne du fichier CSV 
// http://www.html5rocks.com/es/tutorials/file/dndfiles/

function handleFileSelect(evt, str) {
    strBrief = '<strong>Sélectionnez les colonnes pertinentes pour la géolocalisation.</strong><br/>';
    var files = evt.target.files; // FileList object

    // Loop through the FileList .
    for (var i = 0, f; f = files[i]; i++) {
        var reader = new FileReader();
//      if (!f.type.match('image.*')) {
//        continue;
//      }
//        console.log(f.type);
//        console.log(f.name);
        subfijo = f.name.substr( f.name.indexOf(".")+1).toLowerCase();
        
//        console.log(subfijo);
//        if (!testCSV(f)){
        if (subfijo != 'csv'){
            
            $(str).html('<p>Erreur : format de fichier '+ f.name +' incorrect </p>');
            continue;
        }

        // Closure to capture the file information.
        reader.onload = (function () {
            return function (e) {
                // Render thumbnail.
                entete = '<p><input type="checkbox" name="entete" value="true"> Si votre tableau <u>ne contient pas d\'en-tête</u>, cochez cette case.</p>';
                res = e.target.result.split("\n")[0];
                arr = res.split(";");
                columns = '';
                for (j = 0; j < arr.length; j++) {
                    columns += '<div><input id="columns'+j+'" type="checkbox" name="columns[]" value="' + $.trim( arr[j] ) + '"> <label for="columns'+j+'" >' + arr[j] + '<label>   </div>';
                }
                // write html
                // Si votre tableau ne contient pas d'en-tête, cochez cette case
                $(str).html(entete +strBrief + columns);
            };
        })(f);

        // Read into file
        reader.readAsText(f);
    }
}
 function testCSV(file) {
    $mimeType = ['text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext']
    for ($i = 0; $i < $mimeType.length; $i++) {
        if ($mimeType[$i] == file.type) {
            return true;
        }
    }
    return false;
}