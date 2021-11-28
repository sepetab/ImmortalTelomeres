<!DOCTYPE html>
<html>
<head>
	<title>Medication</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
  <!-- SEARCH BAR ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php 
$conn = odbc_connect('z5115189', '', '', SQL_CUR_USE_ODBC);
$picPID = 0;
if(!$conn){exit("Connection Failed:". $conn);}

//Check to see if prescription type is medeication or diet
if(isset($_POST["NewMedication"])){

    $presOpt = $_POST["prescriptionOptions"];
    $sDate = $_POST["startDate"];
    $fDate = $_POST["finishDate"];
    $morning = $_POST["Morning"];
    $afternoon = $_POST["Afternoon"];
    $evening = $_POST["Evening"];

    $time = "";
    if($morning=="on"){
        $morning = "M";
        $time = $time.$morning;
    }
    if($afternoon=="on"){
        $afternoon = "A";
        $time = $time.$afternoon;
    }
    if($evening=="on"){
        $evening = "N";
        $time = $time.$evening;
    }

    //Insert form information into table
    $pid = $_POST["PatientID"];
    $medName = $_POST["MedicationName"];
    $dos = $_POST["Dosage"];
    $roa = $_POST["RouteofAdministration"];
    $insertQuery = "INSERT INTO Medication (PatientID, StartDate, EndDate, MedTime, MedName, Dosage, ROA) VALUES ('$pid','$sDate','$fDate','$time','$medName','$dos','$roa')";
    $insert = odbc_exec($conn,$insertQuery);
  
    //$insertQuery = "INSERT INTO Medication (StartDate, EndDate, Time) VALUES ('$firstName','$lastName','$roomNumber')";
    /*$firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $roomNumber = $_POST["RoomNumber"];
    $insertQuery = "INSERT INTO Patient (FirstName, LastName, RoomNumber) VALUES ('$firstName','$lastName','$roomNumber')";
    $insert = odbc_exec($conn,$insertQuery);

    $getPid = "SELECT @@IDENTITY AS PID FROM Patient";
    $pid = odbc_exec($conn,$getPid);
    while ($row = odbc_fetch_array($pid)) {
        $picPID =  $row['PID'];
        break;
    }*/
}
//If the ser presses edit, we update the table
else if(isset($_POST["editMed"])){

    $presOpt = $_POST["prescriptionOptions"];
    $mid = $_POST["MedicationID"];
    $sDate = $_POST["startDate"];
    $fDate = $_POST["finishDate"];
    $morning = $_POST["morning"];
    $afternoon = $_POST["afternoon"];
    $evening = $_POST["evening"];
    
    $time = "";
    if($morning=="on"){
        $morning = "M";
        $time = $time.$morning;
    }
    if($afternoon=="on"){
        $afternoon = "A";
        $time = $time.$afternoon;
    }
    if($evening=="on"){
        $evening = "N";
        $time = $time.$evening;
    }

    $pid = $_POST["PatientID"];
    $medName = $_POST["MedicationName"];
    $dos = $_POST["Dosage"];
    $roa = $_POST["RouteofAdministration"];
    $updateQuery = "UPDATE Medication SET PatientID = $pid, StartDate = '$sDate', EndDate = '$fDate', MedTime = '$time' , MedName = '$medName' , Dosage = '$dos' , ROA = '$roa' WHERE MedID = $mid";
    $update = odbc_exec($conn,$updateQuery);

}else if(isset($_POST["removeMed"])){
    echo "well i am in the right place";
    $mid = $_POST["MedicationID"];
    $deleteQuery = "DELETE * FROM Medication WHERE MedID = $mid";
    $delete = odbc_exec($conn,$deleteQuery);
} 
?>


<body>
    <header>
        <div class="container-header">
            <a HREF="mainpage.php"><div class="logo-container">
                <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                <p class="subtitle">HealthHacker</p>
            </div></a>
            <nav>
                <ul class="nav-ul">
                    <li class="nav-li"><a class="nav-a" href="mainpage.html">Home</a></li>
                    <li class="nav-li"><a class="nav-a" href="#">Information</a>
                        <ul>
                            <li><a class = "nav-a" href="patients.php">Patient List</a></li>
                            <li><a class = "nav-a" href="dietRegimes.php">Diet Regimes</a></li>
                            <li><a class = "nav-a" href="#">Medication List</a></li>
                            <li><a class = "nav-a" href="practitioners.php">Practitioners</a></li>
                            <li><a class = "nav-a" href="profile.php">Profile</a></li>
                        </ul>
                    </li>
                    <li class="nav-li"><a class="nav-a" href="#">Forms</a>
                        <ul>
                            <li><a class = "nav-a" href="newPatient.html">New Patient</a></li>
                            <li><a class = "nav-a" href="editPatient.html">Edit Patient</a></li>
                            <li><a class = "nav-a" href="newPrescription.html">New Prescription</a></li>
                            <li><a class = "nav-a" href="editPrescription.html">Edit Prescription</a></li>
                        </ul>
                    </li>
                    <li class="nav-li"><a class="nav-a" href="loginFirst.html">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!--normal sign in page -->
    <div class="formContainer">
        <h1>Medications list</h1>
        <!-- Search app -->
        <form class="example" method = "post" action="medications.php" style="margin:auto;max-width:700px">
            <input type="text" placeholder="Enter Medication Name or Medication ID" name="search2">
            <button type="submit" name="search"><i class="fa fa-search"></i> Search for Medication</button>
        </form>
    </div>
        <div>
            <table class="table table-sortable" style="max-width:60%">
                <col style="width:12%">
                <col style="width:12%">
                <col style="width:12%">
                <col style="width:12%">
                <col style="width:12%">
                <col style="width:12%">
                <col style="width:12%">
                <col style="width:12%">
                <thead>
                    <tr>
                        <th>Med ID</th>
                        <th>Patient ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Time</th>
                        <th>Medication Name</th>
                        <th>Dosage</th>
                        <th>ROA</th>
                    </tr>
                </thead>
                <!--Exemplar data-->
                <tbody> 
                    <?php 
                        //Addressing the search bar
                        if(isset($_POST["search"])){
                            $query = $_POST["search2"];
                            if($query){
                                if(is_numeric($query)){
                                    $searchQ = "SELECT * FROM Medication WHERE MedID = $query";
                                }else{
                                    $searchQ = "SELECT * FROM Medication WHERE UCase(MedName) ='" . strtoupper($query) . "'";
                                }
                            }else{
                                $searchQ = "SELECT * FROM Medication";
                            }
                            // echo $searchQ;
                            $searchResults = odbc_exec($conn,$searchQ);
                            while ($row = odbc_fetch_array($searchResults)) {    
                                echo "<tr>";
                            echo "<td>" . $row['MedID'] . "</td>";
                            echo "<td>" . $row['PatientID'] . "</td>";
                            echo "<td>" . $row['StartDate'] . "</td>";
                            echo "<td>" . $row['EndDate'] . "</td>";
                            echo "<td>" . $row['MedTime'] . "</td>";
                            echo "<td>" . $row['MedName'] . "</td>";
                            echo "<td>" . $row['Dosage'] . "</td>";
                            echo "<td>" . $row['ROA'] . "</td>";
                            echo "</tr>";
                            }
                        }else{
                            $medicationsQ = "SELECT * FROM Medication";
                            $medications = odbc_exec($conn,$medicationsQ);
                            while ($row = odbc_fetch_array($medications)) {    
                                echo "<tr>";
                                echo "<td>" . $row['MedID'] . "</td>";
                                echo "<td>" . $row['PatientID'] . "</td>";
                                echo "<td>" . $row['StartDate'] . "</td>";
                                echo "<td>" . $row['EndDate'] . "</td>";
                                echo "<td>" . $row['MedTime'] . "</td>";
                                echo "<td>" . $row['MedName'] . "</td>";
                                echo "<td>" . $row['Dosage'] . "</td>";
                                echo "<td>" . $row['ROA'] . "</td>";
                                //echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
                                //echo "<td>" . $row['RoomNumber'] . "</td>";
                                //echo "<td><img src='./uploads/" . $row['PatientID'] .".png' alt='' height=100 width=100></img></td>";
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
                    <p class="footer-title">HEALTHPORTAL</p>
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
