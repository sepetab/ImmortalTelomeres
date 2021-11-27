<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("File_scripting_languages.txt", "r") or die("can not open file!");
echo fread($myfile,filesize("File_scripting_languages.txt"));
fclose($myfile);
?>

</body>
</html>