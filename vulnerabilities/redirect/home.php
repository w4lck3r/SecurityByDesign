 <div class="thumbnail">
    <div class="caption-full">
        <h4><a href="#">Unvalidated Redirects and Forwards</a></h4>
        
        <p align="justify">
        Some applications use this functionalities to redirects and forward user to other web pages or other website. Such request with poor validation can allow an attacker to redirect legitimate users to phishing or malformed web pages.
        </p>
        <p>Read more about Unvalidated Redirects and Forwards <br>
        <strong><a target="_blank" href="https://www.owasp.org/index.php/Unvalidated_Redirects_and_Forwards_Cheat_Sheet">https://www.owasp.org/index.php/Unvalidated_Redirects_and_Forwards_Cheat_Sheet </a></p></strong>

    </div>

</div>
<div class="well">
    <p>
        <form method="get" action="">
            <div class="form-group">
                <div class="text-left">
                <h3>Major Web Application Security Consortiums</h3> <br>
                <strong>
                <a href="redirect.php?forward=https://www.owasp.org">Open Web Application Security Project</a> <br>
                <a href="redirect.php?forward=http://www.webappsec.org/">The Web Application Security Consortium (WASC)</a>
                </strong>
                <?php 
                    
                    // if (isset($_GET['forward'])){
                    //     $forward=$_GET['forward'];
                    //     if (strlen($forward)>0){
                    //         ob_start();
                    //         ob_end_flush(); 
                    //         header("Location: ".$forward);
                    //     }
                    // }
                    if (isset($_GET['forward'])){
                        $forward = $_GET['forward'];
                        // Vérifier si l'URL est valide
                        if (filter_var($forward, FILTER_VALIDATE_URL)) {
                            header("Location: " . $forward);
                            exit; // Assurez-vous de sortir du script après la redirection
                        } else {
                            // URL invalide, rediriger vers une page d'erreur ou une URL par défaut
                            header("Location: erreur.php");
                            exit;
                        }
                    }
                    // Avec cette correction, nous utilisons la fonction filter_var() avec le filtre
                    // FILTER_VALIDATE_URL pour vérifier si l'URL fournie par l'utilisateur est valide.
                    // Si c'est le cas, nous effectuons la redirection. Sinon, nous pouvons choisir de
                    // rediriger l'utilisateur vers une page d'erreur ou une URL par défaut. Ensuite,
                    // nous utilisons exit() pour arrêter immédiatement l'exécution du script après 
                    // la redirection.
                ?>
                </div>
            </div>
        </form>
    </p>      
    <hr>
    
</div>
<?php include_once('../../about.html'); ?>