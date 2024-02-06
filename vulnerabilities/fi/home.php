<div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
    -->
    <div class="caption-full">
        <h4><a href="#">File Inclusion</a></h4>
        
        <p align="justify">
        File inclusion is an attack that would allow an attacker to access unintended files on the server. This vulnerability exploits application’s functionality to include dynamic files. Two categories in this attack are Local File Inclusion (LFI) and Remote File Inclusion (RFI). 
        </p>
        <p>Read more about File Inclusions <br>
        <strong><a target="_blank" href="https://www.owasp.org/index.php/Testing_for_Local_File_Inclusion">https://www.owasp.org/index.php/Testing_for_Local_File_Inclusion</a></strong>
        <strong><a target="_blank" href="https://www.owasp.org/index.php/Testing_for_Remote_File_Inclusion">https://www.owasp.org/index.php/Testing_for_Remote_File_Inclusion</a></strong>

        </p>

    </div>

</div>

<div class="well">

    <p>
        <form method="get" action="">
            <div class="form-group">
                <br>
                <div class="text-left">
                <?php 
                    $f='readme.txt';
                    // Sanitize file input to prevent directory traversal
                    $file = isset($_GET['file']) ? basename($_GET['file']) : '';
                    $allowed_files = array('readme.txt', 'about.html'); // Define allowed files here
                    
                    // Check if the requested file is allowed
                    if (in_array($file, $allowed_files)) {
                        echo "<a class=\"btn btn-primary\" href=\".?file=$file\" /> Click here </a><br><br>";
                        include($file);
                    } else {
                        echo "Invalid file.";
                    }                
                ?>
                </div>
            </div>
        </form>
    </p>

      
    <hr>
    
</div>
