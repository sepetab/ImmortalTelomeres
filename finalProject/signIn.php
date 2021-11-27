<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // connect to database
    $conn = odbc_connect('z5115189', '', '', SQL_CUR_USE_ODBC);
    if(!$conn){exit("Connection Failed:". $conn);}
    // print("Execution failed:\n");
    // print("   State: ".odbc_error($conn)."\n");
    // print("   Error: ".odbc_errormsg($conn)."\n");
    // exit; 
    // Collect form details
    $user = $_POST['Username'];
    $password = $_POST['Password'];

    $userExistance = "SELECT * FROM Practitioner WHERE userName = '$user'";
    // echo "$userExistance";
    $exists = odbc_exec($conn,$userExistance);

    if(odbc_fetch_row($exists)){
        $exists = odbc_exec($conn,$userExistance);
        while ($row = odbc_fetch_array($exists)) {    
            if($row['Password'] == $password){
                $_SESSION['loggedin'] = true;
<<<<<<< HEAD
                $_SESSION['user'] = $user;
                header('Location: http://engpwws005/z5208102$/ImmortalTelomeres/finalProject/mainPage.html');
=======
                header('Location: http://engpwws005/z5115189$/ImmortalTelomeres/finalProject/mainPage.html');
>>>>>>> 2d6c4404e20ba5878c723729cb40f4260cb9c612
                exit;
            }else{
                include 'loginFirst.html';     
                echo "<h3 style=\"text-align:center;\">Invalid Credentials</h3>";
            }
        }
    }else{
        include 'loginFirst.html';     
        echo "<h3 style=\"text-align:center;\">Invalid Credentials, Username does not exist</h3>";
    }


}


?>