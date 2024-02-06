
<?php
session_start();

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validation des données d'entrée
        $username = htmlspecialchars($username);
      
		
        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        // Requete preparée pour empecher les injections SQL
        $sql = "SELECT username, password FROM users WHERE username = :username";
        $stmt = $conn1->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifie le mot de passe haché
            if (password_verify($hashed_password, $user['password'])) {
                // Authentification réussie
                $_SESSION['user'] = $user['username'];
                header("Location: /xvwa/");
                exit();
            } else {
                // Mot de passe incorrect
                header("Location: /xvwa/login.php?error=invalid_password");
                exit();
            }
        } else {
            // Utilisateur non trouvé
            header("Location: /xvwa/login.php?error=user_not_found");
            exit();
        }
    } else {
        // Données manquantes
        header("Location: /xvwa/login.php?error=missing_data");
        exit();
    }
} else {
    // Accès direct interdit
    header("Location: /xvwa/login.php");
    exit();
}
?>

//////ameliorations apportées /////
//  j'ai ajouté une validation des données d'entrée, utilisé des requêtes préparées pour empêcher les injections SQL,
// et redirigé l'utilisateur en fonction du résultat de l'authentification.
// j'ai aussi verifié le mot de passe.
// un hashage du mot de passe est necessaire pour l'inscription.
// si le mot de passe est hashé il est necessaire de comparer les mots de passe en hashant le mot de passe à verifier
// ou a convertir le mot de passe hashé qui est stocké pour le comparer.

