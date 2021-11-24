<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // connect to database
    $conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
    if(!$conn){exit("Connection Failed:". $conn);}

    // Collect form details
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $userExistance = "SELECT * FROM Practitioner WHERE userName = '$email'";
    // echo "$userExistance";
    $exists = odbc_exec($conn,$userExistance);

    if(odbc_fetch_row($exists)){
        $exists = odbc_exec($conn,$userExistance);
        while ($row = odbc_fetch_array($exists)) {    
            if($row['Password'] == $password){
                $_SESSION['loggedin'] = true;
                include 'mainPage.php';
            }else{
                include 'loginFirst.html';     
                echo "<h3 style=\"text-align:center;\">Invalid Credentials</h3>";
            }
        }
    }else{
        include 'loginFirst.html';     
        echo "<h3 style=\"text-align:center;\">Invalid Credentials</h3>";
    }


}


?>