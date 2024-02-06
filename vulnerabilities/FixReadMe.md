## File Inclusion (FI) Exploit:
* Vulnerable Code (home.php):
```php
<form method="get" action="">
    ...
    <?php 
        $f='readme.txt';
        echo "<a class=\"btn btn-primary\" href=\".?file=$f\" /> Click here </a><br><br>";

        if (isset($_GET['file'])) {
            $file=$_GET['file'];
            include($file);
        }                 
    ?>
    ...
</form>
```

* Fix:

```php

...
<form method="get" action="">
    ...
    <?php 
        // Whitelist allowed files to be included
        $allowed_files = array('file1.php', 'file2.php', 'file3.php');
        $file = isset($_GET['file']) ? $_GET['file'] : '';
        if (in_array($file, $allowed_files)) {
            include($file);
        } else {
            echo "Invalid file.";
        }
    ?>
    ...
</form>
```

## File Upload Exploit:
* Vulnerable Code (home.php):

```php

...
<form method='post' action='' enctype="multipart/form-data">
    ...
    <input type="file" name="image">
    ...
    if($itemname!='' && $itemdesc!='' && $categ!='' && $price!='' && basename( $_FILES['image']['name'])!=''){
        ...
        $path = $_SERVER['DOCUMENT_ROOT'].'/xvwa/img/uploads/';
        $path = $path . basename( $_FILES['image']['name']); 
        if(!move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            echo "<h4><b><font color='red'>There was an error uploading the file, please try again!</font></b></h4>";
        }
        ...
    }
    ...
</form>
...
```
* Fix:

```php
...
<form method='post' action='' enctype="multipart/form-data">
    ...
    <input type="file" name="image">
    ...
    if($itemname!='' && $itemdesc!='' && $categ!='' && $price!='' && basename( $_FILES['image']['name'])!=''){
        ...
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<h4><b><font color='red'>Invalid file format!</font></b></h4>";
        } else {
            $path = $_SERVER['DOCUMENT_ROOT'].'/xvwa/img/uploads/';
            $path = $path . basename($_FILES['image']['name']); 
            if(!move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                echo "<h4><b><font color='red'>There was an error uploading the file, please try again!</font></b></h4>";
            }
            ...
        }
        ...
    }
    ...
</form>
...
```

## CSV Formula Injection:
Vulnerable Code (export.php):

```php

...
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=xvwa-export.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('itemcode', 'itemname', 'categ','price'));

include('../../config.php');  
$sql='SELECT itemcode,itemname,categ,price from caffaine';
$result = $conn->query($sql);

while ($row = mysqli_fetch_assoc($result)) fputcsv($output, $row);
...
```
* Fix:

To fix CSV Formula Injection, ensure that the data being exported to CSV is properly sanitized and validated, especially if it includes user-generated content or potentially dangerous formulas.

## Insecure Direct Object Reference (IDOR):
* Vulnerable Code (home.php):

```php
...
<select class="form-control" name="item">
    ...
</select>
...
<?php
    ...
    $item = isset($_GET['item']) ? $_GET['item'] : '';
    ...
    $sql = "select itemcode,itemname,itemdisplay,itemdesc,categ,price from caffaine where itemid = :itemid";
    $stmt = $conn1->prepare($sql);
    $stmt->bindParam(':itemid',$item);
    ...
?>
...
```
* Fix:

Ensure that the application properly checks the user's authorization level before allowing them to access or modify sensitive data. Implement role-based access control (RBAC) to restrict access to resources based on user roles.
Missing Functional Level Access Control (MissFunc):
Vulnerable Code (home.php):


```php

...
<?php
    ...
    if($_SESSION['user'] == 'admin'){
        echo "<button class='btn btn-default' type='submit' name='action' value='delete'>Delete</button></div>";
    }else{
        echo "</div>";
    }
    ...
?>
...
```

* Fix:

Ensure that the application performs proper authorization checks before allowing users to access or perform sensitive actions. Implement role-based access control (RBAC) to restrict access to actions based on user roles.

