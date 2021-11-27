<!DOCTYPE html>
<html>
<body>

<?php
$handle = fopen("users.txt", "r");
while ($userinfo = fscanf($handle, "%s\t%s\t%s\n")) {
    list ($name, $profession, $countrycode) = $userinfo;
    echo nl2br ("Study PHP at $name and $profession and $countrycode \n");
    //... do something with the values
}
fclose($handle);
?>

</body>
</html>