<div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
      -->
      <div class="caption-full">
        <h4><a href="#">Unrestricted File Upload </a></h4>
        
        <p align="justify">
        As the name depicts, this issues happens when application does not validate file that is being uploaded by user. An attacker can upload malicious files called webshells on the server that could leads to complete server compromise. 
        </p>
        <p>Read more about Unrestricted File Upload<br>
        <strong><a target="_blank" href="https://www.owasp.org/index.php/Unrestricted_File_Upload">https://www.owasp.org/index.php/Unrestricted_File_Upload</a></p></strong>

    </div>
      </div>

      <div class="well">
        <table width="100%" style="border-collapse:collapse; table-layout:fixed;"><tr><td>
          <div class="col-lg-12"> 
            <p><h4>Add New Item to the Coffee List</h4><br>
              <form method='post' action='' enctype="multipart/form-data">
                <div class="form-group"> 
                  <label></label>
                  <span class="file-input btn btn-primary btn-file">
                   Upload Image<input type="file" name="image">
                 </span>
                 <br><br>
                 <input class="form-control" width="50%" placeholder="Item Name" name="item"></input> <br>
                 <textarea class="form-control" placeholder="Description" rows="3" name="desc"></textarea><br>
                 <input class="form-control" width="50%" placeholder="Category" name="categ"></input> <br>
                 <input class="form-control" width="50%" placeholder="Price" name="price"></input> <br>

                 <div align="right"> <button class="btn btn-default" type="submit">Submit Button</button></div>

                 <br>
               </div>
             </form>
           </p>
         </div>
       </td>
       <td>
        <div class="col-lg-12"> 
          <p><h4></h4><br>

            <?php 
            
            error_reporting(E_ALL);

            $itemcode = "XVWA".rand(1000,9999);
            $itemname = isset($_POST['item']) ? $_POST['item'] : '';
            $itemdesc = isset($_POST['desc']) ? $_POST['desc'] : '';
            $categ = isset($_POST['categ']) ? $_POST['categ'] : '';
            $price = isset($_POST['price']) ? $_POST['price']: '';

            // Validate uploaded file
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file_tmp_name = $_FILES['image']['tmp_name'];
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_type = $_FILES['image']['type'];

                // Define allowed file types
                $allowed_types = array('image/jpeg', 'image/png');

                if(in_array($file_type, $allowed_types)) {
                    // Move the uploaded file to a secure location
                    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/xvwa/img/uploads/';
                    $upload_path = $upload_dir . $file_name;

                    if(move_uploaded_file($file_tmp_name, $upload_path)) {
                        // Proceed with database insertion
                        include('../../config.php');

                        if($conn1) {
                            // Prepare and execute database query
                            $stmt = $conn1->prepare("INSERT INTO caffaine (itemcode, itemname, itemdisplay, itemdesc, categ, price) VALUES (:itemcode, :itemname, :itemdisplay, :itemdesc, :categ, :price)");
                            $stmt->bindParam(':itemcode', $itemcode);
                            $stmt->bindParam(':itemname', $itemname);
                            $stmt->bindParam(':itemdisplay', $upload_path); // Store the file path in the database
                            $stmt->bindParam(':itemdesc', $itemdesc);
                            $stmt->bindParam(':categ', $categ);
                            $stmt->bindParam(':price', $price);
                            $stmt->execute();

                            // Fetch and display item details
                            $sql = "SELECT itemname, itemdisplay, itemdesc, categ, price FROM caffaine WHERE itemcode = :itemcode";
                            $stmt = $conn1->prepare($sql);
                            $stmt->bindParam(':itemcode', $itemcode);
                            $stmt->execute();

                            echo "<h4><b><font color='green'>Item Uploaded Successfully !!</font></b></h4><br>";
                            echo "<table>";
                            while($rows = $stmt->fetch(PDO::FETCH_NUM)) {
                                echo "<tr><td><b>Code : </b>" . htmlspecialchars($itemcode) . "</td><td rowspan=5>&nbsp;&nbsp;</td><td rowspan=5 valign=\"top\" align=\"justify\"><b>Description : </b>" . htmlspecialchars($rows[2]) . "</td></tr>";
                                echo "<tr><td><b>Name : </b>" . htmlspecialchars($rows[0]) . "</td></tr>";
                                echo "<td><img src='" . htmlspecialchars($rows[1]) . "' height=130 weight=20/></td>";
                                echo "<tr><td><b>Category : </b>" . htmlspecialchars($rows[3]) . "</td></tr>";
                                echo "<tr><td><b>Price : </b>" . htmlspecialchars($rows[4]) . "$</td></tr>"; 
                            }
                            echo "</table>";
                        } else {
                            echo "Error in connecting to database";
                        }
                    } else {
                        echo "<h4><b><font color='red'>There was an error uploading the file, please try again!</font></b></h4>";
                    }
                } else {
                    echo "<h4><b><font color='red'>Invalid file type. Only JPG and PNG files are allowed.</font></b></h4>";
                }
            } else {
                // Enter full information
            }
            ?>
          </p>
        </div>
      </td></tr></table>
      <hr>
      
    </div>
    <?php include_once('../../about.html'); ?>
