<!DOCTYPE html>
<html>
<body>

<?php
echo substr(sprintf("%o", fileperms("File_scripting_languages.txt")),-4);
?>

</body>
</html>