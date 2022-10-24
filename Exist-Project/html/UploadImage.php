<?php
$uploaddir = './assets/images/products/';
echo "<p>";

foreach ($_FILES['userfile']['name'] as $key => $value) {
    $rand1 = rand('1111111111','9999999999');
    $rand2 = rand('1111111111','9999999999');
    $uploadfile = $uploaddir .$rand1.$rand2.$value;
    if (move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Upload failed";
    }
}


echo "</p>";
echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";
?>
<html>
<form enctype="multipart/form-data" action="#" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="51200000" />
    Send this file: <input name="userfile[]" type="file" multiple>
    <input type="submit" value="Send File" />
</form>

</html>