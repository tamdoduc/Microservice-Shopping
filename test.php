<?php
if (isset($_FILES["userfile"])) {      
    /*$uploaddir = './assets/images/products/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    echo "<p>";

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Upload failed";
    }*/

    echo "</p>";
    echo '<pre>';
    echo 'Here is some more debugging info:';
    print_r($_FILES);
    print "</pre>";
}
?>
<html>
<form enctype="multipart/form-data" action="#" method="POST">
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
</html>