<?php
    session_start();
    $id=$_SESSION['idUser'];
    $name=$_SESSION['nom'];

    include('../inc/function.php');

    $pubs = getPublication();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <title>Welcome <?php echo $name; ?> - Mini Toky</title>
    <script type="text/javascript">

    //Les codes ci dessous sont executé lors que la page est chargée
    window.addEventListener("load", function () {
            
        function sendData() {
            let xhr = createXHR();
        
            // Liez l'objet FormData et l'élément form
            var formData = new FormData(publi);

            // Definissez ce qui se passe pendant le telechargement du responseText -- Readystate = 3
            xhr.addEventListener("loadstart", function(event) {
                    let divPu = document.createElement('div');
                    divPu.className = "vatany_pub";
                    let nom = document.createElement('p');
                    nom.className = "nom-user";
                    nom.innerText = "<?php echo $name; ?>";
                    let contenu = document.createElement('p');
                    let content = document.getElementById('content');
                    let stat = document.createElement('p');
                    stat.innerText = "en cours";
                    stat.id = "charg";
                    stat.className = "chargement";
                    contenu.innerText = content.value;
                    divPu.appendChild(nom);
                    divPu.appendChild(contenu);
                    divPu.appendChild(stat);
                    apercu.appendChild(divPu);
            });

            // Définissez ce qui se passe si la soumission s'est opérée avec succès -- Readystate = 4
            xhr.addEventListener("load", function(event) {
                let stat = document.getElementById("charg");
                stat.innerText = "publie";
                stat.removeAttribute('id');
            });

            // Definissez ce qui se passe en cas d'erreur
            xhr.addEventListener("error", function(event) {
                alert('Oups! Quelque chose s\'est mal passé.');
            });

            // Configurez la requête
            xhr.open("POST", "../inc/traitpubli.php", true);

            // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
            xhr.send(formData);
        }

        // Accédez à l'élément form …
        var publi = document.getElementById("publi");

        // … et prenez en charge l'événement submit.
        publi.addEventListener("submit", function (event) {
            event.preventDefault(); // évite de faire le submit par défaut

            sendData();
        });

        var apercu = document.getElementById("apercu");
    });

    window.setInterval('refresh()', 10000); 	// Call a function every 10000 milliseconds (OR 10 seconds).

    // Refresh or reload page.
    function refresh() {
        window.location.reload();
    }

    function createXHR(){
        let xhr; 
        try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
        catch (e) 
        {
            try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
            catch (e2) 
            {
            try {  xhr = new XMLHttpRequest();  }
            catch (e3) {  xhr = false;   }
            }
        }
        return xhr;
    }

    </script>
</head>
<body>
    <div class="container">
        <div id="form_pub" class="col-md-4">
            <form id="publi">
                <input type="text" name="content" id="content"><br>
                <input type="submit" value="Post">
            </form>
        </div>
        <div class="col-md-8" id="apercu">
            <?php for($i=0; $i<count($pubs); $i++){?>
                <div class="vatany_pub">
                    <p class="nom-user"><?php echo $pubs[$i]['nom']; ?></p>
                    <p><?php echo $pubs[$i]['contenu']; ?></p>
                    <p class="chargement"> il y a <?php echo convTime(timePassed($pubs[$i]['datePub'])); ?></p>
                    <div id="<?php echo "com".$pubs[$i]['id_Pub']; ?>" class="vatany_com">
                        <form id="<?php echo "form_com".$pubs[$i]['id_Pub']; ?>">
                            <input type="text" name="content" class="content"><br>
                            <input type="submit" onclick="submitCom(<?php echo $pubs[$i]['id_Pub']; ?>)" value="Comment">
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>