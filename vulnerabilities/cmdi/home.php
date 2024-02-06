<div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
    -->
    <div class="caption-full">
        <h4><a href="#">OS Command Injection</a></h4>

        <p align="justify">
            Some applications use operating system commands to execute certain functionalities by using bad coding
            practices, say for instance, usage of functions such as system(),shell_exec(), etc. This allows a user to
            inject arbitrary commands that will execute on the remote host with the privilege of web server user. An
            attacker can trick the interpreter to execute his desired commands on the system.
        </p>
        <p>Read more about Command Injection <br>
            <strong><a target="_blank"
                    href="https://www.owasp.org/index.php/Command_Injection">https://www.owasp.org/index.php/Command_Injection
                </a>
        </p></strong>

    </div>

</div>

<!-- Sanitize user input: Make sure to sanitize the user input to prevent any malicious commands from being executed.

Use safer alternatives: Instead of directly using shell_exec() or system() functions with user input, consider using safer alternatives or validating the input thoroughly. -->

<div class="well">
    <div class="col-lg-6">
        <p>Enter your IP/host to ping.
        <form method='get' action=''>
            <div class="form-group">
                <label></label>
                <input class="form-control" width="50%" placeholder="Enter IP/HOSTNAME to Ping" name="target"></input>
                <br>
                <div align="right"> <button class="btn btn-default" type="submit">Submit Button</button></div>
            </div>
        </form>
        </p>
    </div>
    <?php
    if (isset($_REQUEST['target'])) {
        $target = $_REQUEST['target'];
        if ($target) {
            // Sanitize the user input
            $target = escapeshellarg($target);

            if (stristr(php_uname('s'), 'Windows NT')) {
                // Use safer alternative to shell_exec() for Windows
                $cmd = exec('ping ' . $target, $output, $return_var);
                echo '<pre>';
                print_r($output);
                echo '</pre>';
            } else {
                // Use safer alternative to shell_exec() for Unix/Linux
                $cmd = exec('ping -c 3 ' . $target, $output, $return_var);
                echo '<pre>';
                print_r($output);
                echo '</pre>';
            }
        }
    }
    ?>
    <hr>
</div>


<?php include_once('../../about.html'); ?>