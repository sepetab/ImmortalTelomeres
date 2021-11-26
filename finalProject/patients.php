<!DOCTYPE html>
<html>
<head>
	<title>Patients</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
  <!-- SEARCH BAR ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php 
$conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
$picPID = 0;
if(!$conn){exit("Connection Failed:". $conn);}
if(isset($_POST["newPatient"])){
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $roomNumber = $_POST["RoomNumber"];
    $insertQuery = "INSERT INTO Patient (FirstName, LastName, RoomNumber) VALUES ('$firstName','$lastName','$roomNumber')";
    $insert = odbc_exec($conn,$insertQuery);

    $getPid = "SELECT @@IDENTITY AS PID FROM Patient";
    $pid = odbc_exec($conn,$getPid);
    while ($row = odbc_fetch_array($pid)) {
        $picPID =  $row['PID'];
        break;
    }
}else if(isset($_POST["editPatient"])){
    $PID = $_POST["PatientID"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $roomNumber = $_POST["RoomNumber"];
    $picPID =  $PID;
    $updateQuery = "UPDATE Patient SET FirstName = '$firstName', LastName = '$lastName', RoomNumber = '$roomNumber' WHERE PatientID = $PID";
    $update = odbc_exec($conn,$updateQuery);
}else if(isset($_POST["removePatient"])){
    $PID = $_POST["PatientID"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $roomNumber = $_POST["RoomNumber"];
    $deleteQuery = "DELETE * FROM Patient WHERE PatientID = $PID";
    $delete = odbc_exec($conn,$deleteQuery);
} 
// Below If block derived from W3 schools: w3schools.com/php/php_file_upload.asp
if((!isset($_POST["removePatient"])) && isset($_FILES["PatientPicture"]) && $picPID!=0){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["PatientPicture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["PatientPicture"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
    }

    if ($_FILES["PatientPicture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && $imageFileType) {
        if (!move_uploaded_file($_FILES["PatientPicture"]["tmp_name"], './' . $target_dir . $picPID . '.png')) {
            echo "Sorry there was an error uploading your file.";
        }
    }else if($imageFileType){
        echo "Sorry there was an error in file specifications.";
    }

}
?>


<body>
    <header>
        <div class="container-header">
            <a HREF="mainpage.php"><div class="logo-container">
                <img src="img/logo2.png" class="logo" alt="Hearth with stethoscope"/>
                <p class="subtitle">HealthHacker</p>
            </div></a>
            <nav>
                    <ul class="nav-ul">
                        <li class="nav-li"><a class="nav-a" href="#">Information</a>
                            <ul>
                                <li><a class = "nav-a" href="patients.php">Patient List</a></li>
                                <li><a class = "nav-a" href="">Diet Regime</a></li>
                                <li><a class = "nav-a" href="">Medication Regime</a></li>
                            </ul>
                        <li class="nav-li"><a class="nav-a" href="#">Forms</a>
                            <ul>
                                <li><a class = "nav-a" href="newPatient.html">New Patient</a></li>
                                <li><a class = "nav-a" href="editPatient.html">Edit Patient</a></li>
                                <li><a class = "nav-a" href="newPrescription.html">New Prescription</a></li>
                                <li><a class = "nav-a" href="editPrescription.html">Edit Prescription</a></li>
                            </ul>
                        </li>
                        <li class="nav-li"><a class="nav-a" href="">Logout</a></li>
                    </ul>
                </nav>
        </div>
    </header>
    <!-- normal sign in page  -->
    <div class="formContainer">
        <h1>Patients list</h1>
        <form class="example" method = "post" action="patients.php" style="margin:auto;max-width:700px">
            <input type="text" placeholder="Enter Patient's First Name, Last Name or ID" name="search2">
            <button type="submit" name="search"><i class="fa fa-search"></i> Search for patient</button>
        </form>
    </div>

        <div>
            <table class="table table-sortable" style="max-width:60%">
                <col style="width:10%">
                <col style="width:20%">
                <col style="width:20%">
                <col style="width:50%">
                <thead>
                    <tr>
                        <th>PID</th>
                        <th>Name</th>
                        <th>Room Number</th>
                        <th>Profile picture</th>
                    </tr>
                </thead>
                <!-- Exemplar data -->
                <tbody> 
                    <?php 
                        if(isset($_POST["search"])){
                            $query = $_POST["search2"];
                            if($query){
                                if(is_numeric($query)){
                                    $searchQ = "SELECT * FROM Patient WHERE PatientID = $query";
                                }else{
                                    $searchQ = "SELECT * FROM Patient WHERE UCase(FirstName) ='" . strtoupper($query) . "' OR Ucase(LastName) ='" . strtoupper($query) . "'";
                                }
                            }else{
                                $searchQ = "SELECT * FROM Patient";
                            }
                            // echo $searchQ;
                            $searchResults = odbc_exec($conn,$searchQ);
                            while ($row = odbc_fetch_array($searchResults)) {    
                                echo "<tr>";
                                echo "<td>" . $row['PatientID'] . "</td>";
                                echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
                                echo "<td>" . $row['RoomNumber'] . "</td>";
                                echo "<td><img src='./uploads/" . $row['PatientID'] .".png' alt='' height=100 width=100></img></td>";
                                echo "</tr>";
                            }

                        }else{
                            $patientsQ = "SELECT * FROM Patient";
                            $patients = odbc_exec($conn,$patientsQ);
                            while ($row = odbc_fetch_array($patients)) {    
                                echo "<tr>";
                                echo "<td>" . $row['PatientID'] . "</td>";
                                echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
                                echo "<td>" . $row['RoomNumber'] . "</td>";
                                echo "<td><img src='./uploads/" . $row['PatientID'] .".png' alt='' height=100 width=100></img></td>";
                                echo "</tr>";
                            }
                        }
                        
                    
                    ?>
                </tbody>
            </table>                
        </div>
    </div>
    <footer>
            <div class="footer-container">
                <div>
                    <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                </div>
                <div class="middle-footer">
                    <p class="footer-title">HEALTHHACKER WORKSHOP</p>
                    <p class="footer-copyright">&copy; 2021 ImmortalTelomeres</p>
                </div>
                <div>
                    <p class="footer-title">CONTACT US</p>
                    <p class="footer-copyright">+61 432842728</p>
                    <p class="footer-copyright"><A class="footer-mail" HREF="mailto:enquires@hackerhealth.com">enquires@hackerhealth.com</a></p>
                </div>
            </div>
        </footer>
</body>
<script src="script/scriptSignin.js"></script>
</html>
