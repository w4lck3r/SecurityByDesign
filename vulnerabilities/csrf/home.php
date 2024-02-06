<?php
// Start session
session_start();

// Function to generate CSRF token
function generate_csrf_token() {
    return bin2hex(random_bytes(32));
}

// Generate CSRF token and store it in the session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generate_csrf_token();
}
?>

<div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
    -->
    <div class="caption-full">
        <h4><a href="#">Cross Site Request Forgery (CSRF)</a></h4>
        
        <p align="justify">
        CSRF attacks are tricky to identify and exploit as it has certain requirements to fulfill before successful attack. Firstly, a victim has to be in active session, i.e., he should be already logged in. Secondly, an attacker should be able to predict the requests wherein CSRF issues exists and trick victim to click on it. 
        <br></p><p>Login to the application before exploring this vulnerbility. </p>
        <p>Read more about Cross Site Request Forgery (CSRF)<br>
        <strong><a target="_blank" href="https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)">https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF) </a></p></strong>

    </div>
</div>

<div class="well">
    <div class="col-lg-6"> 
        <p><h4>Change your password</h4>  
            <form method='post' action=''>
                <div class="form-group"> 
                    <label></label>
                    <input type="password" class="form-control" width="50%" placeholder="Enter new password" name="passwd"></input> <br>
                    <input type="password" class="form-control" width="50%" placeholder="Confirm new password" name="confirm"></input> <br>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div align="right"> <button class="btn btn-default" type="submit" name="submit" value="submit">Submit Button</button></div>
                </div> 
            </form>
            <?php
            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validate CSRF token
                if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    die("CSRF token validation failed. Please try again.");
                }
                
                $current_user = isset($_SESSION['user']) ? $_SESSION['user'] : '' ;
                $password = isset($_POST['passwd']) ? $_POST['passwd'] : '' ;
                $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : '' ;
                
                // Process password change if user is logged in
                if($current_user){
                    if(isset($_POST['submit'])){
                        if(empty($password) && empty($password)){
                            echo "Passwords can not be blank !! Try Again ";
                        } else if($password != $confirm){
                            echo "Passwords don't match !! Try Again";
                        } else {
                            include('../../config.php');
                            $stmt = $conn1->prepare("UPDATE users set password=:pass where username=:user");
                            $stmt->bindParam(':pass', md5($password));
                            $stmt->bindParam(':user', $current_user);
                            $stmt->execute(); 
                            if($stmt->rowCount() > 0){
                                echo "<b>Password Changed successfully<br></b>";
                            } else {
                                echo "<b>Invalid user<br></b>";
                            }
                        }
                    }
                } else {
                    echo "<b> You are not logged in. </b>";
                }
            }
            ?>
        </p>
    </div>
    <hr>
</div>
<?php include_once('../../about.html'); ?>
