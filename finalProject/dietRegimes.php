<!DOCTYPE html>
<html>
<head>
	<title>DietRegimes</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
  <!-- SEARCH BAR ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php 
$conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
if(!$conn){exit("Connection Failed:". $conn);}
if(isset($_POST["NewDR"])){
    $PID = $_POST["PatientID"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["finishDate"];
    $morning = $_POST["Morning"];
    $afternoon = $_POST["Afternoon"];
    $night = $_POST["Night"];
    $food = $_POST["Food"];
    $exercise = $_POST["Exercise"];
    $beauty = $_POST["Beauty"];
    echo $PID;
    echo $startDate;
    echo $endDate;
    echo $morning;
    echo $afternoon;
    echo $night;
    echo $food;
    echo $exercise;
    echo $beauty;



    // $insertQuery = "INSERT INTO Patient (FirstName, LastName, RoomNumber) VALUES ('$firstName','$lastName','$roomNumber')";
    // $insert = odbc_exec($conn,$insertQuery);


}else if(isset($_POST["editDR"])){
    $PID = $_POST["PatientID"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $roomNumber = $_POST["RoomNumber"];
    $updateQuery = "UPDATE Patient SET FirstName = '$firstName', LastName = '$lastName', RoomNumber = '$roomNumber' WHERE PatientID = $PID";
    $update = odbc_exec($conn,$updateQuery);
}else if(isset($_POST["removeDR"])){
    $PID = $_POST["PatientID"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $roomNumber = $_POST["RoomNumber"];
    $deleteQuery = "DELETE * FROM Patient WHERE PatientID = $PID";
    $delete = odbc_exec($conn,$deleteQuery);
} 
?>


<body>
    <header>
        <div class="container-header">
            <a HREF="mainpage.html"><div class="logo-container">
                <img src="img/logo2.png" class="logo" alt="Hearth with stethoscope"/>
                <p class="subtitle">HealthPortal</p>
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
                        <th>ID</th>
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
                    <p class="footer-title">HEALTHPortal</p>
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
