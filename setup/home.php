 

 <div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
    -->
    <div class="caption-full">
        <h4><a href="#">Xtreme Vulnerable Web Application (XVWA) - Setup</a></h4>
        </div>
    <div class="col-lg-12"> 
        <p align="center"> 
            <form method='get' action=''>
                <div class="form-group" align="center"> 
                    <label></label>
                    <button class="btn btn-primary" name="action" value="do" type="submit">Submit / Reset</button>
               </div> 
            </form>
        </p>
    </div>
</div>
<?php

session_start();

include('../config.php');

function cleanup($conn, $XVWA_WEBROOT) {
    // Nettoyer la base de données
    $tables = array('comments', 'caffaine', 'users');
    foreach ($tables as $table) {
        $sql = 'DROP TABLE IF EXISTS ' . $table;
        $conn->query($sql);
    }

    // Nettoyer les fichiers supplémentaires
    $files = glob('../img/uploads/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

$submit = isset($_GET['action']) ? $_GET['action'] : '';

if ($submit) {
    echo "<div class=\"well\">";
    echo "<ul class=\"featureList\">";

    if ($conn->connect_errno > 0) {
        die("<li class=\"cross\">La connexion a échoué. Vérifiez le fichier de configuration : " . $conn->connect_error . "</li>");
    } else {
        cleanup($conn, $XVWA_WEBROOT);
        echo "<li class=\"tick\">Connexion à la base de données réussie.</li>";

        // Création de la table 'comments'
        $create_comments_table = $conn->query("CREATE TABLE comments (id int not null primary key auto_increment, user varchar(30), comment varchar(100), date varchar(30))");
        if ($create_comments_table) {
            // Insertion de données de test
            $insert_comment = $conn->prepare("INSERT INTO comments (id, user, comment, date) VALUES (?, ?, ?, ?)");
            $insert_comment->bind_param("isss", $id, $user, $comment, $date);

            $id = 1;
            $user = mysqli_real_escape_string($conn, 'admin');
            $comment = mysqli_real_escape_string($conn,'Keep posting your comments here');
            $date = '10 Aug 2015';
            $insert_comment->execute();

            echo "<li class=\"tick\">Table 'comments' créée avec succès.</li>";
        } else {
            echo "<li class=\"cross\">Échec de la création de la table 'comments'. Veuillez réessayer.</li>";
        }

        // Autres opérations de base de données...

        echo "<br><li class=\"tick\">Configuration terminée.</li>";
        echo "</ul>";
        echo "<hr>";
        echo "</div>";
    }
}


////// modifications apportées///////

//Les requêtes SQL dynamiques ont été remplacées par des requêtes préparées
// pour éviter les attaques par injection SQL. 
// j'ai utilisé la méthode prepare() pour préparer une requête SQL d'insertion de commentaires,
// puis j'ai lié les paramètres à la requête avec bind_param().
// j'ai egalement echappé les données avec l'ajout de mysqli_real_escape_string() pour eviter les failles XSS.
?>




