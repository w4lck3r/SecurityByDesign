<?php 
	// if (isset($_GET['forward'])){
	// 	$forward=$_GET['forward'];
	// 	if (strlen($forward)>0){
	// 		header("Location: ".$forward);
	// 	}
	// }
?>

<?php 
    // Liste blanche des URL autorisées
    $allowedURLs = array(
        'https://example.com/allowed_page',
        'https://example.com/another_allowed_page'
    );

    if (isset($_GET['forward'])) {
        $forward = $_GET['forward'];
        // Vérifier si l'URL est dans la liste blanche
        if (strlen($forward) > 0 && in_array($forward, $allowedURLs)) {
            header("Location: " . $forward);
            exit; // Assurez-vous de sortir du script après la redirection
        } else {
            // Gérer le cas où l'URL n'est pas autorisée
            echo "URL non autorisée";
        }
    }

	// Dans cet exemple, seules les URL définies dans la liste $allowedURLs seront autorisées
	//  pour la redirection. Les autres URL seront considérées comme non autorisées et aucune
	//   redirection ne sera effectuée vers celles-ci.
?>
