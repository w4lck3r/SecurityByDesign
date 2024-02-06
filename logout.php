<?php
session_start();
if(session_destroy()){
	// Supprime également le cookie de session coté client
    setcookie(session_name(), '', time() - 3600, '/');
	header("Location: /xvwa/");
}

///// ameliorations apportées /////
// ici j'ai ajouté une suppression du cookie de session coté client, ce qui rend plus difficile pour un attaquant de compromettre la session.
?>