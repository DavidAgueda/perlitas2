
// David Agueda

// Drop

// variables
var dropArea2 = document.getElementById('dropArea2'); // drop area zone JS object
var count2 = document.getElementById('count2'); // text zone to display nb files done/remaining
var result2 = document.getElementById('result2'); // text zone where informations about uploaded files are displayed
var list = []; // file list
var nbDone = 0; // initialisation of nb files already uploaded during the process.


// main initialization
(function () {

    // init handlers
    function initHandlers() {
        dropArea2.addEventListener('drop', handleDrop, false);
        dropArea2.addEventListener('dragover', handleDragOver, false);
    }

    // drag over
    function handleDragOver(event) {
        event.stopPropagation();
        event.preventDefault();

        dropArea2.className = 'hover';
    }

    // drag drop
    function handleDrop(event) {
        event.stopPropagation();
        event.preventDefault();
        $('#progress-bar2').show();
        processFiles(event.dataTransfer.files);
        
    }

    // process bunch of files
    function processFiles(filelist) {
        if (!filelist || !filelist.length || list.length)
            return;

        result2.textContent = '';

        for (var i = 0; i < filelist.length && i < 500; i++) { // limit is 500 files (only for not having an infinite loop)
            list.push(filelist[i]);
        }
        uploadNext();
    }

    // upload file
    function uploadFile(file, status) {

        // prepare XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload.php');
        xhr.onload = function () {
            result2.innerHTML += this.responseText;
            uploadNext();
        };
        xhr.onerror = function () {
            result2.textContent = this.responseText;
            uploadNext();
        };

        // prepare and send FormData
        var formData = new FormData();
        formData.append('myfile', file);
        xhr.send(formData);
    }

    // upload next file
    function uploadNext() {
        if (list.length) {
            var nb = list.length - 1;
            nbDone += 1;
            var nextFile = list.shift();
            count2.textContent = 'Nom de fichier: ' + nextFile.name;


            var myarr = nextFile.name.split(".");
            //var myvar = myarr[1] + ":" + myarr[2];
//            console.log(myarr);
//            console.log(myarr.length);

            if (myarr.length > 2) {
                alert(nextFile.name);
            } else {
                if (myarr[1] === 'csv') {
                    if (nextFile.size >= 20000000) { // 20Mb = generally the max file size on PHP hosts
                        result2.innerHTML += '<div class="f">File too big</div>';
                        uploadNext();
                        alert('Risque de passer la mémoire disponible. Utilisez la méthode suivante pour la sélection de fichier.');
                    } else {
                        var formData = new FormData();
                        formData.append('data', nextFile);
                        updateFileAjaxCSV(formData, 'http://10.37.5.11:8000/reverse/csv/');
                        
                    }
                } else {
                    alert('Le format de fichier est incorrecte.');
                }
            }
            //console.log(nextFile);
        }
    }

    initHandlers();
})();