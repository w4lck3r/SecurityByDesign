<?php
    // session_start();
    // $_SESSION['user']="";
    // session_destroy();
    // header("Location: index.php");
?>

<?php
session_start();

// Efface toutes les données de session
$_SESSION = array();

// Détruit la session
session_destroy();

// Redirige l'utilisateur en toute sécurité vers la page d'accueil
header("Location: https://www.example.com/index.php");
exit; // Assure que le script s'arrête après la redirection

// - Toutes les données de session sont effacées en définissant $_SESSION comme un tableau vide.
// - La session est détruite à l'aide de session_destroy().
// - L'utilisateur est redirigé en utilisant une URL absolue sécurisée 
// (https://www.example.com/index.php) pour éviter les attaques de redirection non sécurisée.
// - La fonction exit est utilisée pour s'assurer que le script s'arrête après la redirection, évitant ainsi toute exécution de code supplémentaire.
?>
