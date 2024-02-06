<div class="thumbnail">
    <!--
        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
    -->
    <div class="caption-full">
        <h4><a href="#">Insecure Direct Object Reference </a></h4>
        
        <p align="justify">
            This vulnerability happens when the application exposes direct objects to an internal resource, such as files, directories, keys, etc. Such mechanisms could lead an attacker to predict objects that would refer to unauthorized resources as well.
        </p>
        <p>Read more about Insecure Direct Object Reference  <br>
            <strong><a target="_blank" href="https://www.owasp.org/index.php/Testing_for_Insecure_Direct_Object_References_(OTG-AUTHZ-004)">https://www.owasp.org/index.php/Testing_for_Insecure_Direct_Object_References_(OTG-AUTHZ-004) </a></p></strong>

    </div>
</div>

<div class="well">
    <div class="col-lg-6"> 
        <p>Search by Itemcode or use search option  
            <form method='GET' action=''>
                <div class="form-group"> 
                    <label></label>
                    <select class="form-control" name="item">
                        <option value="">Select Item Code</option>
                        <?php 
                        include('../../config.php');
                        if($conn1){
                            $sql= 'select itemid from caffaine LIMIT 5';
                            $stmt = $conn1->prepare($sql);
                            $stmt->execute();
                            while($rows = $stmt->fetch(PDO::FETCH_NUM)){
                                echo "<option value=\"".$rows[0]."\">".$rows[0]."</option>";
                            }
                        } 
                        ?>
                    </select><br>
                    <div align="right"> <button class="btn btn-default" type="submit">Submit</button></div>
                </div>
            </form>
        </p>
    </div>

    <div class="col-lg-6">
        <?php
        $item = isset($_GET['item']) ? $_GET['item'] : '';
        if (!empty($item)) {
            include('../../config.php');
            $sql = "SELECT itemcode, itemname, itemdisplay, itemdesc, categ, price FROM caffaine WHERE itemid = :itemid";
            $stmt = $conn1->prepare($sql);
            $stmt->bindParam(':itemid', $item);
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_NUM);
            if ($rows) {
                echo "<table class='table table-striped'>";
                echo "<tr><th>Item Code</th><th>Item Name</th><th>Category</th><th>Price</th></tr>";
                echo "<tr><td>".htmlspecialchars($rows[0])."</td><td>".htmlspecialchars($rows[1])."</td><td>".htmlspecialchars($rows[4])."</td><td>$".htmlspecialchars($rows[5])."</td></tr>";
                echo "</table>";
            } else {
                echo "<p>No item found.</p>";
            }
        }
        ?>
    </div>
    <hr>                           
</div>

<?php include_once('../../about.html'); ?>
