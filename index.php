
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>TP AJAX</title>
    <script type="text/javascript">

    //Les codes ci dessous sont executé lors que la page est chargée
    window.addEventListener("load", function () {
            
        function sendData() {
            var xhr; 
            try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
            catch (e) 
            {
                try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
                catch (e2) 
                {
                try {  xhr = new XMLHttpRequest();}
                catch (e3) {  xhr = false; }
                }
            }
        }
            // Liez l'objet FormData et l'élément form
           
            {
                if(xhr.ready);
            }
            // Definissez ce qui se passe pendant le telechargement du responseText -- Readystate = 3
            xhr.addEventListener("loadstart", function(event) 
            {
               loading(); 
            });

            // Définissez ce qui se passe si la soumission s'est opérée avec succès -- Readystate = 4
            xhr.addEventListener("load", function(event) 
            {
                removeLoader();
                var retour = JSON.parse(xhr.responseText);
                switch(retour){
                    case "success":
                    window.location = "pages/home.php";
                    break;
                    case "error":
                    valiny.innerHTML = "Wrong password";
                    break;
                    case "null":
                    valiny.innerHTML = "Unknown account";
                    break;
                }
                //$msg=(event.target.responseText!="")?event.target.responseText:"OK";
                //alert($msg);
            });
            // Definissez ce qui se passe en cas d'erreur
            xhr.addEventListener("error", function(event) {
                alert('Oups! Quelque chose s\'est mal passé.');
            });

            // Configurez la requête
            xhr.open("GET", "inc/traitlog.php", true);

            // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
            xhr.send(formData);
        });

        // Accédez à l'élément form …
        var form = document.getElementById("myform");
        var formData = new FormData(form);    
        // … et prenez en charge l'événement submit.
        form.addEventListener("submit", function (event) 
        {
            event.preventDefault(); // évite de faire le submit par défaut
            sendData();
        });
        var valiny = document.getElementById("val");
        function loading()
        {
            removeLoader();
            var image = document.createElement('img');
            image.src = "assets/img/Loading_icon.gif";
            image.width = 200;
            valiny.appendChild(image);
        }
       

        function removeLoader(){
            valiny.innerHTML = "";
        }


    </script>
</head>
<body>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <form id="myform">
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">&#128100;</span>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Email" aria-describedby="sizing-addon2">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">&#128273;</span>
                    <input type="password" class="form-control" id="pass" name="password" placeholder="Pass" aria-describedby="sizing-addon2">
                </div>
                <div style="text-align: center;">
                    <input type="submit" id="btn1" class="btn btn-primary" value="LOG IN" aria-describedby="sizing-addon2">
                </div>
            </form>
            <div id="val" style="text-align: center;"></div>
        </div>
    </div>
</body>
</html>