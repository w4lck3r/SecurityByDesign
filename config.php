<?php
$XVWA_WEBROOT = "";
$host = "localhost";
$dbname = 'xvwa';
$user = "root";
$pass = "";

// Connexion à la base de données avec MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Connexion à la base de données avec PDO
try {
    $conn1 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

//// ameliorations apportées ////
// ici je n'ai pas modifié grand chose, j'ai ajouté un message d'erreur en cas d'echec de connexion
// à noter que pour securiser au maximum l'application il est preferable d'utiliser un fichier de configuration en dehors de la racine du serveur web pour stocker 
// des informations sensibles telles que les mots de passe.
// il faut également utiliser des utilisateurs de base de données avec des privilèges limités plutôt que d'utiliser root, surtout en prod.
// l'utilisation des outils de gestion de secrets pourrait améliorer la securité.
?>


