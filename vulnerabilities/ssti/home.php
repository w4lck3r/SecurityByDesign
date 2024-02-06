 

 <div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
    -->
    <div class="caption-full">
        <h4><a href="#">Server Side Template Injection (SSTI)</a></h4>
        
        <p align="justify">
Web application uses templates to make the web pages look more dynamic. Template Injection occurs when user input is embedded in a template in an unsafe manner. However in the initial observation, this vulnerability is easy to mistake for XSS attacks. But SSTI attacks can be used to directly attack web servers’ internals and leverage the attack more complex such as running remote code execution and complete server compromise.          </p>
        <p>Read more about Server Side Template Injection (SSTI)<br>
        <strong><a target="_blank" href="http://blog.portswigger.net/2015/08/server-side-template-injection.html">http://blog.portswigger.net/2015/08/server-side-template-injection.html </a></p></strong>

    </div>

</div>

<div class="well">
    <div class="col-lg-6"> 
        <p>
        Hints: <br>
        <ul>
        <li>Template Engine used is TWIG </li>
        <li>Loader function used = "Twig_Loader_String" </li>
        </ul>
        </p>
        <p>
            <form method='get' action=''>
                <div class="form-group"> 
                    <label></label>
                    <input class="form-control" width="50%" placeholder="Enter Your Name" name="name"></input> <br>
                    <div align="right"> <button class="btn btn-default" type="submit" name='submit'>Submit Button</button></div>
               </div> 
            </form>
            <?php
                //  if (isset($_GET['submit'])) {
                //     $name=$_GET['name'];
                //     // include and register Twig auto-loader
                //     include 'vendor/twig/twig/lib/Twig/Autoloader.php';
                //     Twig_Autoloader::register();
                //     try {
                //           // specify where to look for templates
                //               $loader = new Twig_Loader_String();
  
                //           // initialize Twig environment
                //               $twig = new Twig_Environment($loader);
                //          // set template variables
                //          // render template
                //             $result= $twig->render($name);
                //             echo "Hello $result";
  
                //     } catch (Exception $e) {
                //           die ('ERROR: ' . $e->getMessage());
                //         }
                //     }
                    if (isset($_GET['submit'])) {
                        $name = $_GET['name'];
                        // include and register Twig auto-loader
                        include 'vendor/twig/twig/lib/Twig/Autoloader.php';
                        Twig_Autoloader::register();
                        try {
                            // specify where to look for templates
                            $loader = new Twig_Loader_Array(array(
                                'template' => 'Hello {{ name }}'
                            ));
                            // initialize Twig environment
                            $twig = new Twig_Environment($loader);
                            // set template variables
                            // render template
                            $result = $twig->render('template', array('name' => $name));
                            echo "Hello $result";
                        } catch (Exception $e) {
                            die ('ERROR: ' . $e->getMessage());
                        }
                    }

                    // j'ai utilisé Twig_Loader_Array pour charger un modèle à partir d'une chaîne au lieu de Twig_Loader_String.
                    // Ensuite, j'ai passé l'entrée utilisateur $name en tant que données de modèle sécurisées en utilisant
                    // un tableau associatif. Cela permet de prévenir les attaques SSTI en ne permettant pas l'exécution
                    // de code arbitraire dans les modèles.

            ?>
        </p>
    </div>
      
    <hr>

</div>
<?php include_once('../../about.html'); ?>